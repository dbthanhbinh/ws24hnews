<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google-site-verification" content="oWb56cxgo43qtEshbxBAuffpvfVjlG2-sz00nRpcN5E" />
    <title><?= wp_title() ?></title>    
    <?php wp_head()?>
  </head>
  <body <?php body_class(); ?>>
    <div class="top-header">
      <div class="container">
          <ul id="menu-menu-top-right" class="navigation top-bar-menu right">
              <li class="menu-item "><a href="tel:<?= get_theme_mod('contact_hotline')?>"><i class="fa fa-phone"></i> Hotline: <?= get_theme_mod('contact_hotline')?></a></li>
              <li class="menu-item "><a href="mailto:<?= get_theme_mod('contact_email')?>"><i class="fa fa-envelope-o"></i> <?= get_theme_mod('contact_email')?></a></li>
              <li class="menu-item "><a><i class="fa fa-skype"></i>  Skype: thuthuy08ck3</a></li>
          </ul>
      </div>
      <!-- <div class="container">
        <div class="col-md-3 col-lg-3 render-logo">
          <div class="row">
            <?= render_logo() ?>
          </div>
        </div>
        <div class="top-banner-img col-md-9 col-lg-9">
            <div class="row top-banner-right">
              <a href="#"> <?php echo render_mode_attachment_image('top_banner'); ?> </a>
            </div>
        </div>
      </div> -->
    </div>
    <!-- Navigation -->
    <?php require_once ('modules/menu/menu.php')?>