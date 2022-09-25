<div class="header-section">
    <?php if($boxTitle){?>
        <h3><?= $boxTitle ?> <?php if($subTitle){?><span class="header-cb-1"><?= $subTitle ?></span><?php }?></h3>
    <?php }?>
    <?php if($description){?> <p><?= html_entity_decode($description) ?></p> <?php }?>
    <div class="header-section-icon-container"> <span class='header-section-fa-icon'><?= getBreakSectionClassIconFromConfig() ?></span></div>
</div>