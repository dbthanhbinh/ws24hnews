<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="<?= get_theme_mod('google_site_verification') ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans&family=Raleway&family=Roboto&display=swap" rel="stylesheet">
    <title><?= wp_title() ?></title>
    <?php wp_head()?>
    <script type="text/javascript">
        var adminAjax = '<?php echo admin_url('admin-ajax.php');?>';
    </script>
  </head>
  <body <?php body_class(); ?>>
  <?php
    require_once ('modules/header/header-' . get_theme_mod('header_version', LAYOUT_HEADER_VERSION) . '.php');
  ?>
  <div class="container">
    <div class="top-divider full-width"></div>
  </div>