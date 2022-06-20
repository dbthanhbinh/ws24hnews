<div class="container">
  <div class="row home-section">
    <div class="home-box-title">
			<?php if($showTitle){?><h3 class="section-title"><?= $boxTitle ?></h3><?php }?>
			<?php if($showDescription){?><p><?= $description ?></p><?php }?>
		</div>
  </div>
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
        <div class="col-4 col-sm-4 col-md-4">
            <h2><?= htmlspecialchars_decode($header) ?></h2>
            <div>
            <?= htmlspecialchars_decode($summaries) ?>
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-4 working-hours-container">
            <div class="working-hours">
                <div class="work-bt">
                    <?= htmlspecialchars_decode($workingHours) ?>
                </div>
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-4">
            <div id="demo1-1"></div>
        </div>
        <?php
    } else {
        ?>
        <div class="col-6 col-sm-6 col-md-6">
            <div id="demo1-1"></div>
        </div>
        <div class="col-4 col-sm-4 col-md-4 working-hours-container">
            <div class="working-hours">
                <div class="work-bt">
                    <?= htmlspecialchars_decode($workingHours) ?>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6">
            <h2><?= htmlspecialchars_decode($header) ?></h2>
            <div>
            <?= htmlspecialchars_decode($summaries) ?>
            </div>
        </div>
        <?php
    }
    ?>
  </div>
</div>