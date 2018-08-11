<?php

use trk\theme\Theme;

$header = Theme::get('header');
$navbar = Theme::get('navbar');
$mobile = Theme::get('mobile');

$tag_id = isset($tag_id) ? $tag_id : '';
$position = isset($position) ? $position : '';
$split = isset($split) ? $split : '';
$menu_style = isset($menu_style) ? $menu_style : '';

// Menu ID
if ($id = $tag_id) {
    $attrs['id'] = $id;
}

// determine layout
if (strpos($position, 'navbar') === 0) {

    $layout = $header['layout'];

    if (preg_match('/^(offcanvas|modal)/', $layout)) {

        $type = 'nav';
        $attrs['class'][] = "uk-nav uk-nav-{$navbar['toggle_menu_style']}";
        $attrs['class'][] = $navbar['toggle_menu_center'] ? 'uk-nav-center' : '';

    } else {

        $type = 'navbar';
        $attrs['class'][] = 'uk-navbar-nav';

    }

    if ($layout == 'stacked-center-split' && $split) {

        $length = ceil(count($items) / 2);

        if ($position == 'navbar-split') {
            $items = array_slice($items, 0, $length);
        } else {
            $items = array_slice($items, $length);
        }
    }

} else if ($menu_style == 'subnav' || in_array($position, ['toolbar-left', 'toolbar-right'])) {

    $type = 'subnav';
    $attrs['class'][] = 'uk-subnav';

} else {

    $type = 'nav';
    $attrs['class'][] = 'uk-nav';

    if ($position == 'mobile') {

        $attrs['class'][] = "uk-nav-{$mobile['menu_style']}";
        $attrs['class'][] = $mobile['menu_center'] ? 'uk-nav-center' : '';


    } else if (!array_filter($items, function ($item) { return $item['type'] !== 'header' && (isset($item['children'], $item['link']) && $item['link'] != '#'); })) {
        $params['accorsion'] = true;

        $attrs['class'][] = 'uk-nav-default uk-nav-parent-icon uk-nav-accordion';
        $attrs['uk-nav'] = true;

    } else {

        $attrs['class'][] = 'uk-nav-default';

    }

}
$params['items'] = $items;
$params['level'] = 1;
?>
<ul<?= Theme::attrs($attrs) ?>>
    <?= Theme::view("templates/menu/{$type}", $params) ?>
</ul>
