<?php

use trk\theme\Module;
use trk\uikit\helpers\HtmlHelper;
use trk\uikit\helpers\ArrayHelper;

$config = Module::getConfig('logo');
$attrs_link = [];
$attrs_image = [];

// Logo Text
$logo = $config['text'];

// Link
$attrs_link['href'] = Module::getConfig('appUrl');
$attrs_link['class'][] = isset($class) ? $class : '';
$attrs_link['class'][] = 'uk-logo';

// Image
if ($config['image']) {

    $attrs_image['class'][] = isset($img) ? $img : '';
    $attrs_image['alt'] = $config['text'];

    $ext = HtmlHelper::isImage($config['image']);

    if ($ext == 'gif') {
        $attrs_image['uk-gif'] = true;
    }

    if ($ext == 'svg') {
        $logo = HtmlHelper::image($config['image'], array_merge($attrs_image, ['width' => $config['image_width'], 'height' => $config['image_height']]));
    } else {
        $logo = HtmlHelper::image([$config['image'], 'thumbnail' => [$config['image_width'], $config['image_height']], 'srcset' => true], $attrs_image);
    }

    // Inverse
    if ($config['image_inverse']) {

        $attrs_image['class'][] = 'uk-logo-inverse';

        if (HtmlHelper::isImage($config['image_inverse']) == 'svg') {
            $logo .= HtmlHelper::image($config['image_inverse'], array_merge($attrs_image, ['width' => $config['image_width'], 'height' => $config['image_height']]));
        } else {
            $logo .= HtmlHelper::image([$config['image_inverse'], 'thumbnail' => [$config['image_width'], $config['image_height']], 'srcset' => true], $attrs_image);
        }

    }
}
?>
<a<?= ArrayHelper::attrs($attrs_link) ?>>
    <?= $logo ?>
</a>
