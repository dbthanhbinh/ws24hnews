<?php
global $wpdb;
$tableName = $wpdb->prefix . 'appointment_scope';

// add new
if(isset($_POST['action']) && $_POST['action'] == 'add-scope'){
    if(check_admin_referer('add-scope', 'add-scope')){
        $data=array(
            'name_service' => $_REQUEST['tag-name'],
            'ordering' => $_REQUEST['tag-ordering'],
            'is_active' => 1
        );
        $wpdb->insert($tableName, $data);
    }
}

$results = $wpdb->get_results("SELECT * FROM $tableName ORDER BY `ordering` ASC");
?>
<div id="col-container" class="wp-clearfix">
    <div id="col-left">
        <div class="col-wrap">        
            <div class="form-wrap">
                <h2>Add scope</h2>
                <form method="post" class="validate">
                    <input type="hidden" name="action" value="add-scope">
                    <?php wp_nonce_field('add-scope', 'add-scope'); ?>

                    <div class="form-field form-required term-name-wrap">
                        <label for="tag-name">Scope name</label>
                        <input name="tag-name" id="tag-name" type="text" value="" size="40" aria-required="true">
                        <p>The name is how it appears on your site.</p>
                    </div>
                    <div class="form-field term-ordering-wrap">
                        <label for="tag-ordering">Ordering</label>
                        <input name="tag-ordering" id="tag-ordering" type="number" value="0" size="40">
                    </div>
                    
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Add new">
                        <span class="spinner"></span>
                    </p>
                </form>
            </div>
        </div>
    </div><!-- /col-left -->

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
                            <th scope="col" id="name" class="manage-column column-name column-primary sortable desc"><a href=""><span>Scope Name</span>
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
                            <tr id="timeset-tr-<?= $result->id ?>" class="level-0">
                                <th scope="row" class="check-column">
                                    <label class="screen-reader-text" for="cb-select-2"><?= $result->name_service ?></label>
                                    <input type="checkbox" name="delete_tags[]" value="<?= $result->id ?>" id="cb-select-<?= $result->id ?>">
                                </th>
                                <td class="name column-name has-row-actions column-primary" data-colname="Name">
                                    <strong><a class="row-title" href="#" id="updatetitle-<?= $result->id ?>" ><?= $result->name_service ?></a></strong>
                                    <div class="row-actions">
                                        <span class="inline hide-if-no-js">
                                            <button type="button"
                                                data-trset="timeset-tr-<?= $result->id ?>"
                                                data-action="quickedit"
                                                data-typeof="app-scope"
                                                data-id="<?= $result->id ?>"
                                                data-name="<?= $result->name_service ?>"
                                                data-slots=""
                                                data-ordering="<?= $result->ordering ?>"
                                                class="button-link editinline quickedit-button-js">Quick Edit</button> | 
                                        </span>
                                        <span data-delId="<?= $result->id ?>"
                                            data-trset="timeset-tr-<?= $result->id ?>"
                                            class="delete delete-tag delete-button-js"> <a href="#">Delete</a> </span>
                                    </div>
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