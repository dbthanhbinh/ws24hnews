<?php
    global $wpdb, $categorysTableName, $ourservicesTableName;
    $ourPricingPrefix = 'ourpricing_';
    $addError = "";
    $categoryPricingLs = $wpdb->get_results("SELECT * FROM $categorysTableName ORDER BY `ordering` ASC");
    $categoryOptionsLs = [];
    if ($categoryPricingLs) {
        foreach ($categoryPricingLs as $v) {
            $categoryOptionsLs[] = $v->id . '_' . $v->title;
        }
    }

    // add new category
    if(isset($_POST['action']) && $_POST['action'] == 'our_pricing'){
        if(check_admin_referer('our_pricing', 'our_pricing')){
            $title = trim($_REQUEST[$ourPricingPrefix . 'title']);
            if ($title === null || trim($title) === '') {
                $addError = "Enter our service title!";
            } else if ($title) {
                // Check if title has existed
                $hasExisted = $wpdb->get_results('SELECT * FROM ' . $ourservicesTableName . ' WHERE title="' . $title . '"');
                if($hasExisted) {
                    $addError = "Our service '" . $title . "' has been existed!";
                }
                else {
                    $data = array(
                        'title' => $title,
                        'summaries' => $_REQUEST[$ourPricingPrefix . 'summaries'],
                        'price' => $_REQUEST[$ourPricingPrefix . 'price'],
                        'discount' => $_REQUEST[$ourPricingPrefix . 'discount'],
                        'category_id' => $_REQUEST[$ourPricingPrefix . 'category'],
                        'ordering' => $_REQUEST[$ourPricingPrefix . 'ordering'],
                    );
                    $wpdb->insert($ourservicesTableName, $data);
                    $addError = "";
                }
            }
        }
    }

    // get params &cat=??
    $filter = '';
    $catfilter = $_GET['catfilter'];
    if ($catfilter && $catfilter!=-1) {
        $filter = 'WHERE ourp.category_id=' . $catfilter;
    }

    $query = "
        SELECT ourp.*, courp.title as categoryName, courp.id as categoryId
            FROM $ourservicesTableName as ourp
            LEFT JOIN $categorysTableName as courp
            ON ourp.category_id = courp.id
            $filter
    ";
    $results = $wpdb->get_results( $query.' ORDER BY `ordering` ASC', OBJECT );
?>

<div id="col-container" class="wp-clearfix">
    <div id="col-left">
        <div class="col-wrap">        
            <div class="form-wrap">
                <h3>Our Pricing</h3>
                <?php 
                    if ($addError) print_r('<span style="color: #ff0000;">' . $addError . '</span>');
                ?>
                <form method="post">
                    <input type="hidden" name="action" value="our_pricing">
                    <?php wp_nonce_field('our_pricing', 'our_pricing'); ?>
                    <div class="form-field form-required term-name-wrap">
                        <label for="<?= $ourPricingPrefix . 'title' ?>">
                            <span>Title</span>
                            <input id="<?= $ourPricingPrefix . 'title' ?>" name="<?= $ourPricingPrefix . 'title' ?>" value="" type="text">
                        </label>
                    </div>
                    <div class="form-field form-required term-name-wrap">
                        <label for="<?= $ourPricingPrefix . 'summaries' ?>">
                            <span>Description</span>
                            <textarea id="<?= $ourPricingPrefix . 'summaries' ?>" name="<?= $ourPricingPrefix . 'summaries' ?>"></textarea>
                        </label>
                    </div>
                    <div class="form-field form-required term-name-wrap">
                        <label for="<?= $ourPricingPrefix . 'price' ?>">
                            <span>Price</span>
                            <input id="<?= $ourPricingPrefix . 'price' ?>" name="<?= $ourPricingPrefix . 'price' ?>" value="" type="text">
                        </label>
                    </div>
                    <div class="form-field form-required term-name-wrap">
                        <label for="<?= $ourPricingPrefix . 'discount' ?>">
                            <span>Discount</span>
                            <input id="<?= $ourPricingPrefix . 'discount' ?>" name="<?= $ourPricingPrefix . 'discount' ?>" value="" type="text">
                        </label>
                    </div>
                    <div class="form-field form-required term-name-wrap">
                        <label for="<?= $ourPricingPrefix . 'category' ?>">
                            <span>Category</span>
                            <select id="<?= $ourPricingPrefix . 'category' ?>" name="<?= $ourPricingPrefix . 'category' ?>">
                                <option value="-1"> - Select - </option>
                                <?php
                                if (count($categoryPricingLs) > 0) {
                                    foreach ($categoryPricingLs as $category) {
                                        ?>
                                        <option value="<?= $category->id ?>"> <?= $category->title ?> </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-field form-required term-name-wrap">
                        <label for="<?= $ourPricingPrefix . 'ordering' ?>">
                            <span>Ordering</span>
                            <input id="<?= $ourPricingPrefix . 'ordering' ?>" name="<?= $ourPricingPrefix . 'ordering' ?>" value="1" type="text">
                        </label>
                    </div>
                    <div class="form-field form-required term-name-wrap">
                        <label for="<?= $ourPricingPrefix . 'btn' ?>">
                            <input id="<?= $ourPricingPrefix . 'btn' ?>" name="<?= $ourPricingPrefix . 'btn' ?>" value="Save" class="button button-primary" type="submit">
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="col-right">
        <div class="col-wrap">
            <form id="posts-filter" method="get" action="<?= get_admin_url() ?>admin.php">
                <div class="tablenav top">
                    <input type="hidden" name="page" value="our-pricing" />
                    <div class="alignleft actions bulkactions">
                        <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action fiter</label>
                        <select name="catfilter" id="bulk-action-selector-top">
                            <option value="-1">Filter</option>
                            <?php
                            foreach ($categoryOptionsLs as $k=>$v){
                                ?>
                                <option value="<?= $k ?>"><?= $v ?></option>
                                <?php
                            }
                            ?>                            
                        </select>
                        <input type="submit" id="doaction" class="button action" value="Apply">
                    </div>
                    <div class="tablenav-pages one-page">
                        <span class="displaying-num"><?= count($results) ?> items</span>
                    </div>
                    <br class="clear">
                </div>
                <h2 class="screen-reader-text">Our pricing</h2>
                <table class="wp-list-table widefat fixed striped table-view-list tags">
                    <thead>
                        <tr>
                            <td id="cb" class="manage-column column-cb check-column">
                                <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                                <input id="cb-select-all-1" type="checkbox">
                            </td>
                            <th scope="col" id="name" class="manage-column column-name column-primary sortable desc"><a href=""><span>Name</span>
                                <span class="sorting-indicator"></span></a>
                            </th>
                            <th scope="col" id="price" class="manage-column column-price sortable desc">
                                <a href=""><span>Price</span><span class="sorting-indicator"></span></a>
                            </th>
                            <th scope="col" id="discount" class="manage-column column-discount sortable desc">
                                <a href=""><span>Discount</span><span class="sorting-indicator"></span></a>
                            </th>
                            <th scope="col" id="category" class="manage-column column-category sortable desc">
                                <a href=""><span>Category</span><span class="sorting-indicator"></span></a>
                            </th>
                            <th scope="col" id="slug" class="manage-column column-slug sortable desc">
                                <a href=""><span>Ordering</span><span class="sorting-indicator"></span></a>
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody id="the-list" data-wp-lists="list:tag">
                        <?php
                        foreach($results as $result){
                            ?>
                            <tr id="itemset-tr-<?= $result->id ?>" class="level-0">
                                <th scope="row" class="check-column">
                                    <label class="screen-reader-text" for="cb-select-2"><?= $result->title ?></label>
                                    <input type="checkbox" name="delete_tags[]" value="<?= $result->id ?>" id="cb-select-<?= $result->id ?>">
                                </th>
                                <td class="name column-name has-row-actions column-primary" data-colname="Name">
                                    <strong><a class="row-title" href="#" id="updatetitle-<?= $result->id ?>" ><?= $result->title ?></a></strong>
                                    <!-- For Quick edit -->
                                    <div class="row-actions">
                                        <span class="inline hide-if-no-js">
                                            <button type="button"
                                                data-supname="Our service"
                                                data-action="quickedit"
                                                data-trset="itemset-tr-<?= $result->id ?>"
                                                data-typeof="app-ourservice"
                                                data-prefix="<?= $ourPricingPrefix ?>"
                                                data-colspan="4"
                                                data-table="<?= $ourservicesTableName ?>"
                                                data-id="<?= $result->id ?>"
                                                data-title="<?= $result->title ?>"
                                                data-price="<?= $result->price ?>"
                                                data-discount="<?= $result->discount ?>"
                                                data-category="<?= $result->category_id ?>"
                                                data-ordering="<?= $result->ordering ?>"
                                                data-options="<?= implode(',',$categoryOptionsLs) ?>"
                                                data-updatefields="title,price,discount,category,ordering"
                                                class="button-link editinline btn-our-quickedit-button-js">Quick Edit</button> | 
                                        </span>
                                        <span
                                            data-delId="<?= $result->id ?>"
                                            data-trset="itemset-tr-<?= $result->id ?>"
                                            data-table="<?= $ourservicesTableName ?>"
                                            class="delete delete-tag delete-button-js"> <a href="#">Delete</a> </span>
                                    </div>

                                </td>
                                <td class="slug column-price" data-colname="price">
                                    <span><?= $result->price ?></span>
                                </td>
                                <td class="slug column-discount" data-colname="discount">
                                    <span><?= $result->discount ?></span>
                                </td>
                                <td class="slug column-category" data-colname="category">
                                    <a href="admin.php?page=our-pricing&catfilter=<?= $result->categoryId ?>">
                                        <span id="updatecategory-<?= $result->id ?>"><?= $result->categoryName ?></span>
                                    </a>
                                </td>
                                <td class="slug column-slug" data-colname="ordering">
                                    <span id="updateordering-<?= $result->id ?>"><?= $result->ordering ?></span>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div><!-- /col-right -->
</div>