<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="p:domain_verify" content="029e1ed9c51b3e20c33659c253b080d9"/>
    <title><?= wp_title() ?></title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= get_theme_mod('google_analytics_code') ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '<?= get_theme_mod('google_analytics_code') ?>');
    </script>

    <?php wp_head()?>
  </head>
  <body <?php body_class(); ?>>
  <?php
    require_once ('modules/header/header' . getConfigVersion() . '.php');
  ?>