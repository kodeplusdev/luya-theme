<?php

namespace trk\theme\widgets;

use Yii;
use luya\base\Widget;

/**
 * Build a Navigation data array
 *
 * @author Iskender TOTOGLU <iskender@altivebir.com>
 */
class Languages extends Widget
{
    /**
     * @inheritdoc
     */
    static $currentPage = null;

    /**
     * @inheritdoc
     */
    static $activeLanguage = null;

    /**
     * @inheritdoc
     */
    static $languages = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        self::$currentPage = Yii::$app->menu->current;
        self::$activeLanguage = Yii::$app->adminLanguage->getActiveLanguage();
        self::$languages = Yii::$app->adminLanguage->getLanguages();
    }

    // ------------------------------------------------------------------------

    /**
     * @return string HTML output
     */
    public function run()
    {
        return ''; // $this->toString();
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
     * Return languages as array
     *
     * @return array
     */
    /*
    public static function toArray($items = null)
    {
        $items = $items ?: Yii::$app->adminLanguage->getLanguages();
        $current = self::$current ?: Yii::$app->menu->current;

        $data = [];

        foreach ($items as $item) {
            $data[] = [
                'lang' => $item,
                'item' => Yii::$app->menu->find()->where(['nav_id' => $current->navId])->lang($item['short_code'])->with('hidden')->one(),
            ];
        }

        return $data;
    }
    */

    /**
     * Return languages as array
     *
     * @return array
     */
    public static function toArray() {
        $current = self::$currentPage ?: Yii::$app->menu->current;
        $language = self::$activeLanguage ?: Yii::$app->adminLanguage->getActiveLanguage();
        $languages = self::$languages ?: Yii::$app->adminLanguage->getLanguages();

        $data = [];
        foreach ($languages as $lang) {
            $viewable = Yii::$app->menu->find()->where(['nav_id' => $current->navId])->lang($lang['short_code'])->with('hidden')->one();
            if(!$viewable || $language['id'] == $lang['id']) continue;
            $item = $viewable->itemArray;
            /*
            if($item['is_home'] && !$lang['is_default']) {
                $lang['link'] = $lang['short_code'];
            }  elseif ($item['is_home'] && $lang['is_default']) {
                $lang['link'] = '/';
            } else {
                $lang['link'] = $item['link'];
            }
            */

            if ($item['is_home'] && $lang['is_default']) {
                $lang['link'] = '/';
            } else {
                $lang['link'] = $item['link'];
            }

            switch ($lang['short_code']) {
                case 'en':
                    $flag = 'gb';
                    break;
                default:
                    $flag = $lang['short_code'];
            }

            $data[] = array_merge([
                'type' => '',
                'class' => '',
                'image_class' => '',
                'anchor_title' => '',
                'subtitle' => '',
                'icon' => '',
                'icon_only' => '',
                'divider' => '',
                'target' => '',
                'columns' => '',
                'justify' => '',
                'accordion' => false,
                'title' => '<span class="flag-icon flag-icon-' . $flag . ' uk-margin-small-right"></span> ' . $lang['name'],
                'url' => $lang['link'],
                'active' => '',
                'hasChildren' => '',
                'children' => []
            ], $lang);

        }

        return $data;
    }

    /**
     * Navigation as array
     *
     * @return array
     */
    /*
    public static function toArray($items = null) {
        $items = $items ?: Yii::$app->menu->findAll(['depth' => 1, 'container' => 'default']);
        $data = [];
        $x = 0;
        foreach ($items as $item) {
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
    */
}
