<?php
    function getPosttypeName($posttype){
        global $rg_posttypes;
        $posttypeName = '';
        if($rg_posttypes){
            foreach($rg_posttypes as $k=>$v){
                if($v['posttype'] == $posttype) return $v['postname'];
            }
        }
        return $posttypeName;
    }
?>
<?php
$isShowBreadcrumb = get_theme_mod('show_breadcrumb', IS_SHOW_BREADCRUMB);
if($isShowBreadcrumb){?>
<div class="box-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 box-breadcrumb-part">
                <ul class="breadcrumb">
                    <li><a href="<?= site_url() ?>"><?= __('Home', THEMENAME) ?></a></li>
                    <?php
                    global $post;
                    if(is_single()){
                        if($post->post_type != 'post'){
                            ?>
                            <li><a href="<?= site_url() ?>/<?=$post->post_type?>"><?= getPosttypeName($post->post_type) ?></a></li>
                            <li><span><?= the_title() ?></span></li>
                            <?php        
                        } else {
                            ?>
                            <li><span><?= the_title() ?></span></li>
                            <?php 
                        }
                    } else {
                    ?>
                    <li><span>
                        <?php 
                        if(is_page()){
                            the_title();
                        } else if(is_archive()){
                            the_archive_title();
                        } else if(is_search()){
                            echo 'Tìm: ' . get_query_var('s');
                        }
                        ?>
                    </span></li>
                    <?php }?>
                </ul>        
            </div>
            <div class="col-lg-5 col-md-5 social-search">
                <?php get_template_part('template-parts/socials/content', '')?>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</div>
<?php }?>