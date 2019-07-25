<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= wp_title() ?></title>    
    <?php wp_head()?>
  </head>
  <body <?php body_class(); ?>>
  <?php
    require_once ('modules/header/header-' . getConfigVersion() . '.php');
  ?>