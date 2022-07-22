<?php
global $wpdb, $categorysTableName;
$ourPricingPrefix = 'ourpricing_cat_';
$addError = "";
// add new category
if(isset($_POST['action']) && $_POST['action'] == 'category_pricing'){
    if(check_admin_referer('category_pricing', 'category_pricing')){
        $title = trim($_REQUEST[$ourPricingPrefix . 'title']);
        if ($title === null || trim($title) === '') {
            $addError = "Enter category title!";
        } else if ($title) {
            // Check if title has existed
            $hasExisted = $wpdb->get_results('SELECT * FROM ' . $categorysTableName . ' WHERE title="' . $title . '"');
            if($hasExisted) {
                $addError = "Category '" . $title . "' has been existed!";
            }
            else {
                $data = array(
                    'title' => $title,
                    'summaries' => $_REQUEST[$ourPricingPrefix . 'summaries'],
                    'ordering' => $_REQUEST[$ourPricingPrefix . 'ordering'],
                );
                $wpdb->insert($categorysTableName, $data);
                $addError = "";
            }
        }
    }
}

$results = $wpdb->get_results("SELECT * FROM $categorysTableName ORDER BY `ordering` ASC");
?>

<div id="col-container" class="wp-clearfix">
    <div id="col-left">
        <div class="col-wrap">        
            <div class="form-wrap">                
                <h3>Our Pricing category</h3>
                <?php 
                if ($addError) print_r('<span style="color: #ff0000;">' . $addError . '</span>');
                ?>
                <form method="post">
                    <input type="hidden" name="action" value="category_pricing">
                    <?php wp_nonce_field('category_pricing', 'category_pricing'); ?>

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
            <form id="posts-filter" method="post">
                <h2 class="screen-reader-text">Categories list</h2>
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
                                <td class="name column-name has-row-actions column-name" data-colname="Name">
                                    <strong><a class="row-title" href="#" id="updatetitle-<?= $result->id ?>" ><?= $result->title ?></a></strong>
                                    
                                    <!-- For Quick edit -->
                                    <div class="row-actions">
                                        <span class="inline hide-if-no-js">
                                            <button type="button"
                                                data-supname="Category pricing"
                                                data-action="quickedit"
                                                data-trset="itemset-tr-<?= $result->id ?>"
                                                data-typeof="app-ourcategory"
                                                data-colspan="2"
                                                data-table="<?= $categorysTableName ?>"
                                                data-prefix="<?= $ourPricingPrefix ?>"
                                                data-id="<?= $result->id ?>"
                                                data-title="<?= $result->title ?>"
                                                data-summaries="<?= $result->summaries ?>"
                                                data-ordering="<?= $result->ordering ?>"
                                                data-updatefields="title,summaries,ordering"
                                                class="button-link editinline btn-our-quickedit-button-js">Quick Edit</button> | 
                                        </span>
                                        <span
                                            data-delId="<?= $result->id ?>"
                                            data-trset="itemset-tr-<?= $result->id ?>"
                                            data-table="<?= $categorysTableName ?>"
                                            class="delete delete-tag delete-button-js"> <a href="#">Delete</a> </span>
                                    </div>

                                </td>
                                <td class="slug column-ordering" data-colname="ordering">
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