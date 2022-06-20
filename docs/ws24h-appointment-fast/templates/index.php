<div class="home-section section appointment-section">
    <div class="container">
        <?php
        if ($showTitle == 'y' || $showDescription == 'y') { ?>
        <div class="row">
            <div class="home-box-title">
                <?php if($showTitle == 'y'){?><h3 class="section-title"><?= $boxTitle ?></h3><?php }?>
                <?php if($showDescription == 'y'){?><p><?= $description ?></p><?php }?>
            </div>
        </div>
        <?php } ?>
        <?php
            $showLayoutStyle = '';
            if(isset($showLayout) && $showLayout == 'lr'){
                $showLayoutStyle = 'appointment-left-right';
            } else {
                $showLayoutStyle = 'appointment-right-left';
            }
        ?>
        <div class="row <?= $showLayoutStyle ?>">
            <?php
            if(isset($showLayout) && $showLayout == 'lr'){
                ?>
                <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                    <h2><?= htmlspecialchars_decode($option_value['header']) ?></h2>
                    <div>
                    <?= htmlspecialchars_decode($option_value['summaries']) ?>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-4 working-hours-container">
                    <div class="working-hours">
                        <div class="work-bt">
                            <?= htmlspecialchars_decode($option_value['workinghours']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                    <div id="demo1-1"></div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                    <div id="demo1-1"></div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-4 working-hours-container">
                    <div class="working-hours">
                        <div class="work-bt">
                        <?= htmlspecialchars_decode($option_value['workinghours']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                    <h2><?= htmlspecialchars_decode($option_value['header']) ?></h2>
                    <div>
                    <?= htmlspecialchars_decode($option_value['summaries']) ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>