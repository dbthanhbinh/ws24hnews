<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= wp_title() ?></title>    
    <?php wp_head()?>
  </head>
  <body <?php body_class(); ?>>
    <div class="top-header">
      <div class="container">
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
      </div>
    </div>
    <!-- Navigation -->
    <?php require_once ('modules/menu/menu.php')?>