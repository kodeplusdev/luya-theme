<?php

use trk\theme\Module;
use trk\uikit\helpers\ArrayHelper;

$sidebar = Module::getConfig('sidebar');
$id = 'avb-sidebar';
$class = ["avb-sidebar uk-width-{$sidebar['width']}@{$sidebar['breakpoint']}"];

if ($sidebar['first']) {
    $class[] = "uk-flex-first@{$sidebar['breakpoint']}";
}

?>

<aside<?= ArrayHelper::attrs(compact('id', 'class')) ?>>
    <?php echo Module::sidebar("sidebar:grid-stack") ?>
</aside>

