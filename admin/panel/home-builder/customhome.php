<h2><?= __('Build group template', THEMENAME) ?></h2> <?php echo $save ?>
<?php
require('defaultVal.php');
for($g = 1; $g<=2; $g++){
    ?>
    <div class="tiepanel-item">
        <h3 style="background: darkgray;"><strong><?= __('Group template', THEMENAME) ?> <?=$g?></strong></h3>
        <?php
            $groupPos = $g;
            $group = 'home_group_'.$groupPos;
            if($g == 1){
                tie_options(
                    array(	"name" => __('Big image',THEMENAME),
                            "id" => $group . "_upload_big",
                            "help" => "Upload a big image, or enter URL to an image if it is already uploaded. the theme default big image gets applied if the input field is left blank.",
                            "type" => "upload",
                            "std" => $defaultBigImg,
                            "extra_text" => 'size (MAX) : 800px x 830px'));
            }
            
            $max = 6;
            if($g == 2){
                $max = 3;

                tie_options(
                    array(	"name" => __('Left title',THEMENAME),
                            "id" => $group . "_left_title",
                            "help" => "e.g. Left title",
                            "type" => "text",
                            "std" => ''
                        ));
                tie_options(
                    array(	"name" => __('Right title',THEMENAME),
                            "id" => $group . "_right_title",
                            "help" => "e.g. Right title",
                            "type" => "text",
                            "std" => ''
                        ));
                tie_options(
                    array(	"name" => __('Slogan',THEMENAME),
                            "id" => $group . "_groupslogan",
                            "help" => "e.g. sub slogan title",
                            "type" => "text",
                            "std" => $_groupslogan
                        ));
                tie_options(
                    array(	"name" => "Group text view all ",
                            "id" => $group . "_groupviewall",
                            "help" => "e.g. All services",
                            "std" => $_groupviewall,
                            "type" => "text"));
                tie_options(
                    array(	"name" => "Group URL view all",
                            "id" => $group . "_urlall",
                            "help" => "e.g. http://mydomain.com/viewall",
                            "type" => "text"));
            }

            for ($i=1; $i<=$max; $i++){
                $imgUrl = isset($defaultGroup2Img['_itemImg_'.$i]) ? $defaultGroup2Img['_itemImg_'.$i] : '';
                if($g == 2) {
                    $imgUrl = isset($defaultGroup1Img['_itemImg_'.$i]) ? $defaultGroup1Img['_itemImg_'.$i] : '';
                } 
                echo '<br/>';
                tie_options(
                    array(	"name" => "<b>Item Image</b> " .$i,
                            "id" => $group . "_upload_item_".$i,
                            "help" => "Upload a item image",
                            "type" => "upload",
                            "std" => $imgUrl,
                            "extra_text" => 'size (MAX) : 350px x 350px'));
                tie_options(
                    array(	"name" => "Item title " . $i,
                            "id" => $group . "_title_item_".$i,
                            "help" => "e.g. Item title",
                            "std" => isset($defaultItemVal['_itemTitle_'.$i]) ? $defaultItemVal['_itemTitle_'.$i] : '',
                            "type" => "text"));
                tie_options(
                    array(	"name" => "Item URL " . $i,
                            "id" => $group . "_url_item_".$i,
                            "help" => "e.g. http://mydomain.com/id",
                            "type" => "text"));
                tie_options(
                    array(	"name" => "Item description " . $i,
                            "id" => $group . "_description_item_".$i,
                            "std" => isset($defaultItemVal['_itemDes_'.$i]) ? trim($defaultItemVal['_itemDes_'.$i]) : '',
                            "type" => "textarea"));
            }		
        ?>

    </div>
    <?php
}
?>