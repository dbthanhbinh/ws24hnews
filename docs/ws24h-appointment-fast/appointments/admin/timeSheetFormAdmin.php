<?php
global $wpdb, $timesheetsTableName, $scopeResults;
$timeSheetPrefix = 'timesheet_';
$addError = "";
// Add new
if(isset($_POST['action']) && $_POST['action'] == 'add-timesheet'){
    if(check_admin_referer('add-timesheet', 'nonce-timesheet')){
        $scope = $_REQUEST['tag-scope'];
        // Check if title has existed
        $hasExisted = $wpdb->get_results('SELECT * FROM ' . $timesheetsTableName . ' WHERE scope="' . $scope . '"');
        if($hasExisted) {
            $timeName = (isset($scopeResults[$scope]) && $scopeResults[$scope]) ? $scopeResults[$scope] : '';
            $addError = "Time sheet '" . $timeName . "' has been existed!";
        }
        else {
            $data=array(
                'scope' => $_REQUEST['tag-scope'],
                'slots' => $_REQUEST['tag-slots'],
                'ordering' => $_REQUEST['tag-ordering'],
                'is_active' => 1
            );
            $wpdb->insert($timesheetsTableName, $data);
        }
        
    }
}

$results = [];
$query = "SELECT * FROM $timesheetsTableName ORDER BY `ordering` ASC";
$rs = $wpdb->get_results($query);

// Process get Time name
$categoryOptionsLs = [];
foreach ($scopeResults as $k=>$v) {
    $categoryOptionsLs[] = $k.'_'.$v;
}

if ($rs) {
    foreach ($rs as $item) {
        $timeName = (isset($scopeResults[$item->scope]) && $scopeResults[$item->scope]) ? $scopeResults[$item->scope] : '';
        $results[$item->id] = [
            'id' => $item->id,
            'scope' => $item->scope,
            'timeName' => $timeName,
            'ordering' => $item->ordering,
            'slots' => $item->slots
        ];
    }
}
?>
<div id="col-container" class="wp-clearfix">
    <div id="col-left">
        <div class="col-wrap">        
            <div class="form-wrap">
                <h2>Add time sheets</h2>
                <?php 
                    if ($addError) print_r('<span style="color: #ff0000;">' . $addError . '</span>');
                ?>
                <form method="post" class="validate">
                    <input type="hidden" name="action" value="add-timesheet">
                    <?php wp_nonce_field('add-timesheet', 'nonce-timesheet'); ?>

                    <div class="form-field term-scope-wrap">
                        <label for="<?= $timeSheetPrefix . 'scope' ?>">Time sheet</label>
                        <select name="<?= $timeSheetPrefix . 'scope' ?>" id="<?= $timeSheetPrefix . 'scope' ?>">
                            <option value="-1"> -- None -- </option>
                            <?php
                            foreach ($scopeResults as $k=>$val) {
                                ?>
                                <option value="<?= $k ?>"> <?= $val ?> </option>
                                <?php    
                            }
                            ?>
                        </select>
                        <p>This is Limit time's</p>
                    </div>
                    <div class="form-field term-slots-wrap">
                        <label for="<?= $timeSheetPrefix . 'slots' ?>">Slots</label>
                        <input name="<?= $timeSheetPrefix . 'slots' ?>" id="<?= $timeSheetPrefix . 'slots' ?>" type="number" value="5" size="40">
                        <p>This is Limit number People per time</p>
                    </div>
                    <div class="form-field term-ordering-wrap">
                        <label for="<?= $timeSheetPrefix . 'ordering' ?>">Ordering</label>
                        <input name="<?= $timeSheetPrefix . 'ordering' ?>" id="<?= $timeSheetPrefix . 'ordering' ?>" type="number" value="0" size="40">
                        <p>To ordering</p>
                    </div>
                    <p class="submit">
                        <input type="submit" name="<?= $timeSheetPrefix . 'submit' ?>" id="<?= $timeSheetPrefix . 'submit' ?>" class="button button-primary" value="Add time">
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
                <?php wp_nonce_field('filter-timesheet'); ?>
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
                            <tr id="itemset-tr-<?= $result['id'] ?>" class="level-0">
                                <th scope="row" class="check-column">
                                    <label class="screen-reader-text" for="cb-select-2"><?= 'fasdf' ?></label>
                                    <input type="checkbox" name="delete_tags[]" value="<?= $result['id'] ?>" id="cb-select-<?= $result['id'] ?>">
                                </th>
                                <td class="name column-name has-row-actions column-primary" data-colname="Name">
                                    <strong><a class="row-title" href="#" id="updatetitle-<?= $result['id'] ?>" ><?= $result['timeName'] ?></a></strong>
                                    <div class="row-actions">
                                        <span class="inline hide-if-no-js">
                                            <button type="button"
                                                data-supname="Time sheet"
                                                data-action="quickedit"
                                                data-trset="itemset-tr-<?= $result['id'] ?>"
                                                data-typeof="app-ourtimesheet"
                                                data-prefix="<?= $timeSheetPrefix ?>"
                                                data-colspan="4"
                                                data-table="<?= $timesheetsTableName ?>"
                                                data-id="<?= $result['id'] ?>"
                                                data-scope="<?= $result['scope'] ?>"
                                                data-slots="<?= $result['slots'] ?>"
                                                data-ordering="<?= $result['ordering'] ?>"
                                                data-options="<?= implode(',',$categoryOptionsLs) ?>"
                                                data-updatefields="scope,slots,ordering"
                                                class="button-link editinline btn-our-quickedit-button-js">Quick Edit</button> | 
                                        </span>
                                        <span
                                            data-delId="<?= $result['id'] ?>"
                                            data-trset="itemset-tr-<?= $result['id'] ?>"
                                            data-table="<?= $timesheetsTableName ?>"
                                            class="delete delete-tag delete-button-js"> <a href="#">Delete</a> </span>
                                    </div>
                                </td>
                                <td class="slug column-scope" data-colname="scope">
                                    <span id="updatescope-<?= $result['id'] ?>"><?= $result['scope'] ?></span>
                                </td>
                                <td class="slug column-slug" data-colname="ordering">
                                    <span id="updateordering-<?= $result['id'] ?>"><?= $result['ordering'] ?></span>
                                </td>
                                <td class="posts column-posts" data-colname="Count">
                                    <a href="#" id="updateslots-<?= $result['id'] ?>"><?= $result['slots'] ?></a>
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