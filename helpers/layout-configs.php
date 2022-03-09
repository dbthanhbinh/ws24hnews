<?php
require_once ('enums.php');
$layout = LAYOUT_ARCHIVE_DEFAULT;
if(is_front_page() || is_home()){
   $layout = get_theme_mod('home_layout', LAYOUT_HOME_DEFAULT);
   $mainLayoutClass = $enum_layout[$layout]['main'];
} else if(is_page()){
   $layout = get_theme_mod('page_layout');
} else if(is_single()){
   $layout = get_theme_mod('single_layout');
} else if(is_archive() || is_search()){
   $layout = get_theme_mod('archive_layout');
} else {
    $layout = LAYOUT_ARCHIVE_DEFAULT;
}

$layoutOptions = (isset($enum_layout) && isset($enum_layout[$layout]))
                  ? $enum_layout[$layout]
                  : $enum_layout[LAYOUT_ARCHIVE_DEFAULT];

function isMainSidebar(){
   global $layoutOptions;
   return $layoutOptions['sidebar'] ? $layoutOptions['sidebar'] : false;
}

function isSecondSidebar(){
   global $layoutOptions;
   return $layoutOptions['second'] ? $layoutOptions['second'] : false;
}

function mainLayoutClass($mdFull = false){
   global $layoutOptions;
   if($mdFull)
      return $layoutOptions['mainfull']; else return $layoutOptions['main']; 
}

function mainLayoutKey() { 
   global $layoutOptions;
   return $layoutOptions['key'];
}

function mainLayoutTemplate($isGrid = false){
   return  $isGrid ? 'article-grid' : 'article-list';
}

function getThumbSize($layout, $cols){
   $thumb = 'thumbnail';
   if(!$layout || !$cols)
      return $thumb;
   
   if($layout == LAYOUT_FULL){
      if($cols == 4)
         return 'thumbnail';
      elseif($cols == 3)
         return 'medium';
      elseif($cols == 2)
         return 'large';
      elseif($cols == 7)
         return 'large';
      elseif($cols == 712)
         return 'large';
      else
         return $thumb;
   }
   else {
      if($cols == 4)
         return 'thumbnail';
      elseif($cols == 3)
         return 'thumbnail';
      elseif($cols == 2)
         return 'large';
      elseif($cols == 7)
         return 'large';
      elseif($cols == 712)
         return 'large';
      else
         return $thumb;
   }
}

function getDefaultFullLayout(){
   return 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12';
}

// .col- [<576px], .col-sm- [≥576px], .col-md- [≥768px], .col-lg- [≥992px], col-xl- [≥1200px]
function getColsLayout($isGrid, $cols) {
   $cardColClass = getDefaultFullLayout();
   if($isGrid){
      $cardColClass = 'col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3';
      if($cols == 1)
         $cardColClass = 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12';
      else if($cols == 3)
         $cardColClass = 'col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4';
      else if($cols == 6)
         $cardColClass = 'col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2';
      else if($cols == 2)
         $cardColClass = 'col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6';
      else if($cols == 126)
         $cardColClass = 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6';
      else if($cols == 5)
         $cardColClass = 'col-6 col-sm-6 col-md-5 col-lg-5 col-xl-5';
      else if($cols == 7)
         $cardColClass = 'col-6 col-sm-6 col-md-7 col-lg-7 col-xl-7';
      else if($cols == 157)
         $cardColClass = 'col-12 col-sm-6 col-md-5 col-lg-5 col-xl-5';
      else if($cols == 84)
         $cardColClass = 'col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8';
      else if($cols == 48)
         $cardColClass = 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4';
      else if($cols == 126)
         $cardColClass = 'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6';
      else if($cols == 1633)
         $cardColClass = 'col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3';
      else if($cols == 1336)
         $cardColClass = 'col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3';
      else if($cols == 13333)
         $cardColClass = 'col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3';
      else if($cols == 1444)
         $cardColClass = 'col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4';
      else if($cols == 512)
         $cardColClass = 'col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5';
      else if($cols == 712)
         $cardColClass = 'col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7';
      
   }

   return $cardColClass;
}

/**
 * Get properties to display on layout like number of cols, author ...
 */
function getLayoutArgs($archiveId) {
   if(!$archiveId) return [];

   $archive_display = tie_get_option($archiveId.'_display');
   $archive_cols = tie_get_option($archiveId.'_cols');
   $archiveAuthor = tie_get_option($archiveId.'_meta_author');
   $archiveDate = tie_get_option($archiveId.'_meta_date');
   $archiveReadMore = tie_get_option($archiveId.'_meta_readmore');

   return [
      'isGrid' => ($archive_display && $archive_display == 'grid') ? true : false,
      'cols' => $archive_cols,
      'layout' => $mainLayout,
      'author' => $archiveAuthor,
      'date' => $archiveDate,
      'readMore' => $archiveReadMore
   ];
}

function getSingleArticleContentLayout() {
   return 'col-lg-12 article-content';
}

function getOneColumnContentLayout() {
   return 'col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12';
}

$mainLayout = mainLayoutKey();