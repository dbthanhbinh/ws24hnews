<?php
global $wpdb;
$timesetsTb = $wpdb->prefix.'appointment_timesets'; // timesets
$appointmentTb = $wpdb->prefix.'appointments'; // Appointments
$tableService = $wpdb->prefix . 'appointment_service';
$tableScope = $wpdb->prefix . 'appointment_scope';
// $services = $wpdb->get_results("SELECT * FROM $tableService ORDER BY `ordering` ASC");

$items_per_page = 5;
$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
$offset = ( $page * $items_per_page ) - $items_per_page;

$query = "
    SELECT atb.*, ttb.scope as scopeTimeset, ttb.slots as slots, stb.name_service as serviceName, scopetb.name_service as scope_name_service
        FROM $appointmentTb as atb
        LEFT JOIN $timesetsTb as ttb
        ON atb.timeset = ttb.id
        LEFT JOIN $tableService as stb
        ON atb.service_id = stb.id
        LEFT JOIN $tableScope as scopetb
        ON ttb.scope = scopetb.id
";
$total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
$total =$wpdb->get_var($total_query);
$appointments = $wpdb->get_results( $query.' ORDER BY id DESC LIMIT '. $offset.', '. $items_per_page, OBJECT );

function getTimeset($set_year, $set_month, $set_date, $rangetime = null, $format = 'D-M-Y') {
    if ($rangetime)
        return "$rangetime : $set_date-$set_month-$set_year";
    return "$set_date-$set_month-$set_year";
}

$results = $appointments;
// print_r($results);
?>
<div id="col-container" class="wp-clearfix">
    <div class="col-wrap">
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
                <form class="search-form wp-clearfix" method="get">
                    <input type="hidden" name="page" value="appointments">

                    <p class="search-box">
                        <label class="screen-reader-text" for="phone-search-input">Search:</label>
                        <input type="search" id="phone-search-input" name="s" placeholder="Phone ..." value="<?php echo get_search_query('s'); ?>">
                        <input type="submit" id="search-submit" class="button" value="Search">
                    </p>
                </form>
            </div>
            <br class="clear">
        </div>

        <h2 class="screen-reader-text">Categories list</h2>
        <table class="wp-list-table widefat fixed striped table-view-list table-appointments tags">
            <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">Select All</label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th scope="col" id="name" class="manage-column column-name column-primary sortable desc">
                        <a href=""><span>Full name</span>
                        <span class="sorting-indicator"></span></a>
                    </th>
                    <th scope="col" class="manage-column column-author">
                        <a href=""><span>Phone</span><span class="sorting-indicator"></span></a>
                    </th>
                    <th scope="col" class="manage-column column-posts num sortable desc">
                        <a href=""><span>Service</span><span class="sorting-indicator"></span></a>
                    </th>
                    <th scope="col" class="date column-date">
                        <a href=""><span>Timeset</span><span class="sorting-indicator"></span></a>
                    </th>
                    <th scope="col" class="date column-date">
                        <a href=""><span>Customer note</span><span class="sorting-indicator"></span></a>
                    </th>
                    <th scope="col" class="date column-date">
                        <a href=""><span>Admin note</span><span class="sorting-indicator"></span></a>
                    </th>
                    <th scope="col" class="manage-column column-posts num sortable desc">
                        <a href=""><span>Coupon</span><span class="sorting-indicator"></span></a>
                    </th>
                    <th scope="col" class="date column-date">
                        <a href=""><span>Created</span><span class="sorting-indicator"></span></a>
                    </th>
                </tr>
            </thead>

            <tbody id="the-list" data-wp-lists="list:tag">
                <?php
                foreach($results as $result){
                    $isNew = $result->is_new ? 'style="font-weight: bold;"' : '';
                    ?>
                    <tr id="timeset-tr-<?= $result->id ?>" class="level-0">
                        <th scope="row" class="check-column">
                            <label class="screen-reader-text" for="cb-select-2"><?= $result->full_name ?></label>
                            <input type="checkbox" name="delete_tags[]" value="<?= $result->id ?>" id="cb-select-<?= $result->id ?>">
                        </th>
                        <td class="name column-name has-row-actions column-primary" data-colname="Name">
                            <strong><a <?= $isNew ?> class="row-title" href="#" id="updatetitle-<?= $result->id ?>" ><?= $result->full_name ?></a></strong>
                            <div class="row-actions">
                                <span class="inline hide-if-no-js">
                                    <button type="button"
                                        data-trset="timeset-tr-<?= $result->id ?>"
                                        data-action="quickedit"
                                        data-id="<?= $result->id ?>"
                                        data-name="<?= $result->full_name ?>"
                                        data-phone="<?= $result->phone ?>"
                                        data-customernote="<?= $result->custom_note ?>"
                                        data-adminnote="<?= $result->admin_note ?>"
                                        class="button-link editinline quickedit-appointment-button-js">Quick Edit</button> | 
                                </span>
                                <span data-delId="<?= $result->id ?>"
                                    data-trset="timeset-tr-<?= $result->id ?>"
                                    class="delete delete-tag delete-appointment-button-js"> <a href="#">Delete</a> </span>
                            </div>
                        </td>
                        <td class="manage-column column-author" data-colname="phone">
                            <span id="updatephone-<?= $result->id ?>"><?= $result->phone ?></span>
                        </td>
                        <td class="posts column-posts" data-colname="Count">
                            <a href="#" id="updateservice-<?= $result->id ?>"><?= $result->serviceName ?></a>
                        </td>
                        <td class="date column-date" data-colname="Count">
                            <a href="#" id="updatetimeset-<?= $result->id ?>">
                                <?=  getTimeset($result->set_year, $result->set_month, $result->set_date, $result->scope_name_service) ?>
                            </a>
                        </td>
                        <td class="date column-date" data-colname="Count">
                            <a href="#" id="updatecustomernote-<?= $result->id ?>"><?= $result->custom_note ?></a>
                        </td>
                        <td class="date column-date" data-colname="Count">
                            <a href="#" id="updateadminnote-<?= $result->id ?>"><?= $result->admin_note ?></a>
                        </td>
                        <td class="posts column-posts" data-colname="Count">
                            <a href="#" id="updatecoupon-<?= $result->id ?>"><?= $result->coupon ?></a>
                        </td>
                        <td class="date column-date" data-colname="Count">
                            <a href="#" id="updatecreated-<?= $result->id ?>"><?= $result->created ?></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="tablenav bottom appointment-paginate">
        <?php
            echo 'Total: ' . $total . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            echo paginate_links( array(
                'base' => add_query_arg( 'cpage', '%#%' ),
                'format' => '',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => ceil($total / $items_per_page),
                'current' => $page
            ));
        ?>
        </div>
    </div>
</div>