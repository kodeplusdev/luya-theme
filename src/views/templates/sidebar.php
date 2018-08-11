<?php

use trk\theme\Theme;

$sidebar = Theme::get('sidebar');
$id = 'avb-sidebar';
$class = ["avb-sidebar uk-width-{$sidebar['width']}@{$sidebar['breakpoint']}"];

if ($sidebar['first']) {
    $class[] = "uk-flex-first@{$sidebar['breakpoint']}";
}

?>

<aside<?= Theme::attrs(compact('id', 'class')) ?>>
    <?php echo Theme::sidebar("sidebar:grid-stack") ?>
</aside>

