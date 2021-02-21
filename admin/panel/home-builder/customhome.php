<h2>Custom Home Tempate</h2> <?php echo $save ?>

<?php
for($g = 1; $g<=2; $g++){
    ?>
    <div class="tiepanel-item">
        <h3>Group template <?=$g?></h3>
        <?php
            $groupPos = $g;
            $group = 'home_group_'.$groupPos;
            if($g == 1){
                tie_options(
                    array(	"name" => "Group Big Image",
                            "id" => $group . "_upload_big",
                            "help" => "Upload a big image, or enter URL to an image if it is already uploaded. the theme default big image gets applied if the input field is left blank.",
                            "type" => "upload",
                            "extra_text" => 'size (MAX) : 190px x 60px'));
            }
            
            $max = 6;
            if($g == 2){
                $max = 3;

                tie_options(
                    array(	"name" => "Group slogan ",
                            "id" => $group . "_groupslogan",
                            "help" => "e.g. sub slogan title",
                            "type" => "text"));
                tie_options(
                    array(	"name" => "Group text view all ",
                            "id" => $group . "_groupviewall",
                            "help" => "e.g. All services",
                            "type" => "text"));
                tie_options(
                    array(	"name" => "Group URL view all",
                            "id" => $group . "_urlall",
                            "help" => "e.g. http://mydomain.com/viewall",
                            "type" => "text"));
            }

            for ($i=1; $i<=$max; $i++){
                echo '<br/>';
                tie_options(
                    array(	"name" => "Item Image " .$i,
                            "id" => $group . "_upload_item_".$i,
                            "help" => "Upload a item image",
                            "type" => "upload",
                            "extra_text" => 'size (MAX) : 190px x 60px'));
                tie_options(
                    array(	"name" => "Item title " . $i,
                            "id" => $group . "_title_item_".$i,
                            "help" => "e.g. Item title",
                            "type" => "text"));
                tie_options(
                    array(	"name" => "Item URL " . $i,
                            "id" => $group . "_url_item_".$i,
                            "help" => "e.g. http://mydomain.com/id",
                            "type" => "text"));
                tie_options(
                    array(	"name" => "Item description " . $i,
                            "id" => $group . "_description_item_".$i,
                            "type" => "textarea"));
            }		
        ?>

    </div>
    <?php
}
?>