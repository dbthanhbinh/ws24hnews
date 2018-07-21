<?php
class ThemeMods {
    private $themeMods; 
    public function __construct() {
        $this->themeMods = get_theme_mods();
    }

    public function getMods($modName = '') {
        if (!$modName)
            return null;
        return $this->themeMods[$modName];
    }
}
$themeMods = new ThemeMods();