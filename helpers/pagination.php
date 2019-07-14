<?php
echo '<div class="clear-15"></div>';
the_posts_pagination([
    'screen_reader_text' => __( '&nbsp;' ), 
    'before'      => '<div class="page-links">' . __( 'Pages:', THEME_NAME ),
    'after'       => '</div>',
    'link_before' => '<span class="page-number">',
    'link_after'  => '</span>',
    'prev_text'   => __('Trước'),
    'next_text'   => __( 'Sau' ),
]);
?>