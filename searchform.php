<?php
    $search_placeholder = __('Search_placeholder', THEMENAME);
    $search_btn = __('Search_btn', THEMENAME);
?>

<div class="box-search-form">
    <form role="search" method="get" id="searchform" class="searchform" action="<?= site_url() ?>">
        <div>
            <input type="text" placeholder="<?= $search_placeholder ?>" value="<?php echo get_query_var( 's', $search_placeholder); ?>" name="s" id="s">
            <input type="submit" id="searchsubmit" value="<?= $search_btn ?>">
            <span>
                <i class="fa fa-search" aria-hidden="true"></i>
            </span>
        </div>
    </form>
</div>