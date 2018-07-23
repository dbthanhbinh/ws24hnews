<div class="box-search-form">
    <form role="search" method="get" id="searchform" class="searchform" action="<?= site_url() ?>">
        <div>
            <input type="text" placeholder="Tìm..." value="<?php echo get_query_var( 's', 'Tìm...'); ?>" name="s" id="s">
            <input type="submit" id="searchsubmit" value="Tìm">
            <span><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
    </form>
</div>