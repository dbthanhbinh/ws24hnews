<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= wp_title() ?></title>    
    <?php wp_head()?>
  </head>
  <body <?php body_class(); ?>>
    <?php if(get_theme_mod('show_top_header') || get_theme_mod('show_header')):?>
    <div class="top-header">
      <?php if(get_theme_mod('show_top_header')):?>
      <div class="container top-header-menu">
          <ul class="navigation top-bar-menu right">
              <li class="menu-item "><a href="tel:<?= get_theme_mod('contact_hotline')?>"><i class="fa fa-phone"></i> Hotline: <?= get_theme_mod('contact_hotline')?></a></li>
          </ul>
      </div>
      <?php
      endif;
      if(get_theme_mod('show_header')):
      ?>
      <div class="container top-header-banner">
        <div class="row">
          <div class="top-banner-img col-md-9 col-lg-9 col-sm-9">
              <div class="top-banner-right">
                <a href="#"> <?php echo render_mode_attachment_image('top_banner'); ?> </a>
              </div>
          </div>
          <div class="col-md-3 col-lg-3 render-logo">
              <?= render_logo() ?>
          </div>
        </div>
      </div>
      <?php endif;?>
    </div>
    <?php endif;?>
    <!-- Navigation -->
    <?php require_once ('modules/menu/menu.php')?>