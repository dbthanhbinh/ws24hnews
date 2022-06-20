<?php
global $wpdb;
$tableName = $wpdb->prefix . 'appointment_timesets';

// add new
if(isset($_POST['action']) && $_POST['action'] == 'add-timesets'){
    if(check_admin_referer('add-timesets', 'nonce-timesets')){
        $data=array(
            'scope' => $_REQUEST['tag-scope'],
            'slots' => $_REQUEST['tag-slots'],
            'ordering' => $_REQUEST['tag-ordering'],
            'is_active' => 1
        );
        $wpdb->insert($tableName, $data);
    }
}

$timesetsTb = $wpdb->prefix . 'appointment_timesets';
$scopeTb = $wpdb->prefix . 'appointment_scope';

$query = "
    SELECT atb_time.*, scope_tb.name_service as range_name
        FROM $timesetsTb as atb_time
        LEFT JOIN $scopeTb as scope_tb
        ON scope_tb.id = atb_time.scope
";
$results = $wpdb->get_results($query);

$tableScope = $wpdb->prefix . 'appointment_scope';
$scopeResults = $wpdb->get_results("SELECT * FROM $tableScope ORDER BY `ordering` ASC");
?>
<div id="col-container" class="wp-clearfix">
    <div id="col-left">
        <div class="col-wrap">        
            <div class="form-wrap">
                <h2>Add Range time</h2>
                <form method="post" class="validate">
                    <input type="hidden" name="action" value="add-timesets">
                    <?php wp_nonce_field('add-timesets', 'nonce-timesets'); ?>

                    <div class="form-field term-scope-wrap">
                        <label for="tag-scope">Scope time</label>
                        <select name="tag-scope" id="tag-scope">
                            <option value="-1"> -- None -- </option>
                            <?php
                            foreach ($scopeResults as $k=>$val) {
                                ?>
                                <option value="<?= $val->id ?>"> <?= $val->name_service ?> </option>
                                <?php    
                            }
                            ?>
                        </select>
                        <p>This is Limit time's scope</p>
                    </div>
                    <div class="form-field term-slots-wrap">
                        <label for="tag-slots">Slots</label>
                        <input name="tag-slots" id="tag-slots" type="number" value="5" size="40">
                        <p>This is Limit number People per range</p>
                    </div>
                    <div class="form-field term-ordering-wrap">
                        <label for="tag-ordering">Ordering</label>
                        <input name="tag-ordering" id="tag-ordering" type="number" value="0" size="40">
                        <p>This is Limit number People per range</p>
                    </div>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Add Range time">
                        <span class="spinner"></span>
                    </p>
                </form>
            </div>
        </div>
    </div><!-- /col-left -->

    <div id="col-right">
        <div class="col-wrap">
            <form id="posts-filter" method="post">
                <input type="hidden" name="taxonomy" value="category">
                <input type="hidden" name="post_type" value="post">
                
                <?php wp_nonce_field('filter-timesets'); ?>

                <div class="tablenav top">
                    <div class="alignleft actions bulkactions">
                        <label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
                        <select name="action" id="bulk-action-selector-top">
                            <option value="-1">Bulk actions</option>
                            <option value="delete">Delete</option>
                        </select>
                        <input type="submit" id="doaction" class="button action" value="Apply">
                    </div>
                    <div class="tablenav-pages one-page">
                        <span class="displaying-num"><?= count($results) ?> items</span>
                    </div>
                    <br class="clear">
                </div>

                <h2 class="screen-reader-text">Categories list</h2>
                <table class="wp-list-table widefat fixed striped table-view-list tags">
                    <thead>
                        <tr>
                            <td id="cb" class="manage-column column-cb check-column">
                                <label class="screen-reader-text" for="cb-select-all-1"><?= __('Select all', PLUGIN_DOMAIN) ?></label>
                                <input id="cb-select-all-1" type="checkbox">
                            </td>
                            <th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
                                <a href="#"><span><?= __('Range Name', PLUGIN_DOMAIN) ?></span>
                                <span class="sorting-indicator"></span></a>
                            </th>
                            <th scope="col" id="slug" class="manage-column column-slug sortable desc">
                                <a href=""><span><?= __('Scope time', PLUGIN_DOMAIN) ?></span><span class="sorting-indicator"></span></a>
                            </th>
                            <th scope="col" id="slug" class="manage-column column-slug sortable desc">
                                <a href=""><span><?= __('Ordering', PLUGIN_DOMAIN) ?></span><span class="sorting-indicator"></span></a>
                            </th>
                            <th scope="col" id="posts" class="manage-column column-posts num sortable desc">
                                <a href=""><span><?= __('Limit', PLUGIN_DOMAIN) ?></span><span class="sorting-indicator"></span></a>
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody id="the-list" data-wp-lists="list:tag">
                        <?php
                        foreach($results as $result){
                            ?>
                            <tr id="timeset-tr-<?= $result->id ?>" class="level-0">
                                <th scope="row" class="check-column">
                                    <label class="screen-reader-text" for="cb-select-2"><?= $result->range_name ?></label>
                                    <input type="checkbox" name="delete_tags[]" value="<?= $result->id ?>" id="cb-select-<?= $result->id ?>">
                                </th>
                                <td class="name column-name has-row-actions column-primary" data-colname="Name">
                                    <strong><a class="row-title" href="#" id="updatetitle-<?= $result->id ?>" ><?= $result->range_name ?></a></strong>
                                    <div class="row-actions">
                                        <span class="inline hide-if-no-js">
                                            <button type="button"
                                                data-trset="timeset-tr-<?= $result->id ?>"
                                                data-action="quickedit"
                                                data-id="<?= $result->id ?>"
                                                data-name="<?= $result->range_name ?>"
                                                data-slots="<?= $result->slots ?>"
                                                data-scope="<?= $result->scope ?>"
                                                data-ordering="<?= $result->ordering ?>"
                                                class="button-link editinline quickedit-button-js">Quick Edit</button> | 
                                        </span>
                                        <span data-delId="<?= $result->id ?>"
                                            data-trset="timeset-tr-<?= $result->id ?>"
                                            class="delete delete-tag delete-button-js"> <a href="#">Delete</a> </span>
                                    </div>
                                </td>
                                <td class="slug column-scope" data-colname="scope">
                                    <span id="updatescope-<?= $result->id ?>"><?= $result->scope ?></span>
                                </td>
                                <td class="slug column-slug" data-colname="ordering">
                                    <span id="updateordering-<?= $result->id ?>"><?= $result->ordering ?></span>
                                </td>
                                <td class="posts column-posts" data-colname="Count">
                                    <a href="#" id="updateslots-<?= $result->id ?>"><?= $result->slots ?></a>
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