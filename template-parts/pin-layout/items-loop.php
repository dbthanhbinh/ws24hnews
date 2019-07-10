<div class="col-md-<?php echo $showposts;?> items-gid">
    <?php if(has_post_thumbnail()):?>
        <div class="items-thumb">
            <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                <?php the_post_thumbnail("medium");?>
            </a>
        </div>
    <?php endif;?>

    <div class="items-body">
        <h5 class="items-title">
            <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
        </h5>

        <div class="items-excerpt">
            <?php the_excerpt();?>
            <?php require ('loop-price.php');?>
        </div>

        <div class="items-readmore">
            <?php
            if(function_exists('ws24h_tie_arc_meta_datetime'))
                ws24h_tie_arc_meta_datetime();
            ?>
            <?php //echo '<a href="'.get_permalink().'">Chi tiết.</a>'; ?>
        </div>
    </div>
</div>