<?php

namespace trk\theme\widgets;

use Yii;
use luya\base\Widget;

/**
 * Build a Navigation data array
 *
 * @author Iskender TOTOGLU <iskender@altivebir.com>
 */
class Navigation extends Widget
{

    /**
     * @return string HTML output
     */
    public function run()
    {
        return $this->toString();
    }

    // ------------------------------------------------------------------------

    /**
     * Navigation as string
     *
     * @param null $items
     * @return string
     */
    public static function toString($items = null) {
        $items = $items ?: Yii::$app->menu->findAll(['depth' => 1, 'container' => 'default']);
        $out = "<ul>";
        foreach ($items as $item) {
            /**
             * @var $item \luya\cms\menu\Item
             */
            $class = [];
            if($item->isActive) $class[] = 'uk-active';
            $class = count($class) ? ' class="' . implode(' ', $class) . '"' : '';
            $out .= "<li{$class}><a href='{$item->link}' title='{$item->title}'>{$item->title}</a>";
            if($item->hasChildren) {
                $out .= self::toString($item->children);
            }
            $out .= '</li>';
        }
        $out .= "</ul>";

        return $out;
    }

    // ------------------------------------------------------------------------

    /**
     * Navigation as array
     *
     * @return array
     */
    public static function toArray($items = null) {
        $items = $items ?: Yii::$app->menu->findAll(['depth' => 1, 'container' => 'default']);
        $data = [];
        $x = 0;
        foreach ($items as $item) {
            /**
             * @var $item \luya\cms\menu\Item
             */
            $i = $x++;
            $data[$i] = $item->itemArray;
            $data[$i] = array_merge($item->itemArray, [
                'type' => $item->getPropertyValue('navType', ''),
                'class' => $item->getPropertyValue('navClass', ''),
                'image_class' => $item->getPropertyValue('navImageClass', ''),
                'anchor_title' => $item->getPropertyValue('navAnchorTitle', $item->title),
                'subtitle' => $item->getPropertyValue('navSubtitle', ''),
                'icon' => $item->getPropertyValue('navIcon', ''),
                'icon_only' => $item->getPropertyValue('navIconOnly', ''),
                'divider' => $item->getPropertyValue('navDivider', ''),
                'target' => $item->getPropertyValue('navTarget', '') ? '_blank' : '',
                'columns' => $item->getPropertyValue('navColumns', 1),
                'justify' => $item->getPropertyValue('navJustify', ''),
                'accordion' => false,
                'url' => $item->link,
                'active' => $item->isActive,
                'hasChildren' => $item->hasChildren,
                'children' => []
            ]);
            if($item->hasChildren) {
                $data[$i]['children'] = self::toArray($item->children);
            }
        }

        return $data;
    }
}
