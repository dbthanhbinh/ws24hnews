<?php get_header();?>
<?php require_once ('helpers/layout-configs.php'); ?>
<!-- slide show here-->
<?php if(get_theme_mod('show_main_slideshow')) { ?>
    <?php
    $tie_slider_enable = tie_get_option('slider');
    $tie_slider_pos = tie_get_option('slider_pos');
    if($tie_slider_enable && ($tie_slider_pos=='big' || !$tie_slider_pos)):
    ?>
    <div class="clear-line-5"></div>
    <?php include TEMPLATEPATH . ('/modules/owl-carousel/slide-show.php')?>
    <?php endif;?>
<?php } ?>

<!-- Main content show here-->
<div class="home-container">
    <div class="clear-15"></div>
    

        <!-- <section class="services-section container">
            <div class="row">

                <div class="custom-card-item col-md-4">
                    <div class="card-inner">
                        <div class="card-wrapper">
                            <div class="wrapper-image">
                                <a href="#!">
                                    <svg class="figure-animated-dashes"> 
                                        <rect rx="50%" ry="50%">  </rect>
                                    </svg>
                                    <img src="https://www.lemonspa.beplusthemes.com/lemon-spa-beauty/wp-content/uploads/2018/07/circle1-346x346.jpg" alt="circle1" title="circle1">
                                </a>
                            </div>
                            <div class="wrapper-space">
                                <span class="space-inner"></span>
                            </div>
                            <h3 class="wrapper-heading">Massage Therapy</h3>
                            <div class="wrapper-content">
                                <div class="content-wrapper">
                                    <p>Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci lobortis…</p>
                                </div>
                            </div>
                            <div class="wrapper-readmore"> 
                                <a class="readmore-rounded" href="http://bearsthemespremium.com/theme/lemon-spa-beauty/service/massage-therphy-2/" title="">
                                    <i class="rounded-icon fa fa-long-arrow-right"></i> Get Massage
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-card-item col-md-4">
                    <div class="card-inner">
                        <div class="card-wrapper">
                            <div class="wrapper-image">
                                <figure class="image-figure">
                                    <a href="#!">
                                        <svg class="figure-animated-dashes"> 
                                            <rect rx="50%" ry="50%">  </rect>
                                        </svg>
                                        <img src="https://www.lemonspa.beplusthemes.com/lemon-spa-beauty/wp-content/uploads/2018/07/circle1-346x346.jpg" alt="circle1" title="circle1">
                                    </a>
                                </figure>
                            </div>
                            <div class="wrapper-space">
                                <span class="space-inner"></span>
                            </div>
                            <h3 class="wrapper-heading">Massage Therapy</h3>
                            <div class="wrapper-content">
                                <div class="content-wrapper">
                                    <p>Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci lobortis…</p>
                                </div>
                            </div>
                            <div class="wrapper-readmore"> 
                                <a class="readmore-rounded" href="http://bearsthemespremium.com/theme/lemon-spa-beauty/service/massage-therphy-2/" title="">
                                    <i class="rounded-icon fa fa-long-arrow-right"></i> Get Massage
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-card-item col-md-4">
                    <div class="card-inner">
                        <div class="card-wrapper">
                            <div class="wrapper-image">
                                <figure class="image-figure">
                                    <a href="#!">
                                        <svg class="figure-animated-dashes"> 
                                            <rect rx="50%" ry="50%">  </rect>
                                        </svg>
                                        <img src="https://www.lemonspa.beplusthemes.com/lemon-spa-beauty/wp-content/uploads/2018/07/circle1-346x346.jpg" alt="circle1" title="circle1">
                                    </a>
                                </figure>
                            </div>
                            <div class="wrapper-space">
                                <span class="space-inner"></span>
                            </div>
                            <h3 class="wrapper-heading">Massage Therapy</h3>
                            <div class="wrapper-content">
                                <div class="content-wrapper">
                                    <p>Phasellus enim libero, blandit vel sapien vitae, condimentum ultricies magna et. Quisque euismod orci lobortis…</p>
                                </div>
                            </div>
                            <div class="wrapper-readmore"> 
                                <a class="readmore-rounded" href="http://bearsthemespremium.com/theme/lemon-spa-beauty/service/massage-therphy-2/" title="">
                                    <i class="rounded-icon fa fa-long-arrow-right"></i> Get Massage
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-extra row">
                    <div class="card-extra-left col-md-8">
                        <div class="extra-column-inner">
                            <div class="extra-wrapper">
                                <h4 class="extra-heading">
                                    <strong>Rejuvenate</strong> <i>Your Mind, Body and Soul</i>
                                </h4>
                                <h5 class="extra-custom-heading">Day-to-Day tasks in a Healthy Way</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-extra-right col-md-4">
                        <div class="extra-column-inner">
                            <div class="extra-wrapper">
                                <div class="extra-space">
                                    <span class="extra-space-inner"></span>
                                </div>
                                <div class="extra-btn-right"> 
                                    <a class="#" href="#!" title="">
                                        EXPLORE ALL SERVICES
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section> -->

        


</div>
<!-- End Main content show here-->

<!-- Footer show here-->
<?php get_footer();?>