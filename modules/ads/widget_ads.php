
<?php
function renderAds ($list) {
    $html = '<ul>';
    if (!empty($list)) {
        foreach ($list as $item) {
            $target = $item["target"] ? $item["target"] : '';
            $href = $item["href"] ? $item["href"] : '';
            $html .= $item["src"] ? '<li><a href="'. $href .'" title="'.$item["title"].'" target="'. $target .'"><img alt="'.$item["title"].'" src="'.$item["src"].'" /></a></li>' : '';
        }
    }
    $html .= '</ul>';
    echo $html;
}