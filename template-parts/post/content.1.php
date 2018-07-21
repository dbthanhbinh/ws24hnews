<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <?php 
            if (has_post_thumbnail()) :
                ?>
                <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'thumbnail', ['class'=>'card-img-top'] )?></a>
                <?php        
            endif;    
        ?>
        <div class="card-body">
            <h4 class="card-title">
            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            </h4>
            <p class="card-text">
                <?php the_excerpt();?>
            </p>
        </div>
    </div>
</div>