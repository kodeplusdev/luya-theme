<?php

namespace trk\theme;

use Yii;
use luya\base\CoreModuleInterface;
use trk\uikit\helpers\ArrayHelper;

/**
 * Theme Module
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
final class Module extends \luya\base\Module implements CoreModuleInterface
{
    /**
     * @inheritdoc
     */
    static $configs = [
        'title' => '',
        'appUrl' => '',
        'page' => '',
        'language' => '',
        'icons' => [],
        'site' => [],
        'logo' => [],
        'header' => [],
        'navbar' => [],
        'mobile' => [],
        'top' => [],
        'sidebar' => [],
        'bottom' => [],
        'footer' => []
    ];

    /**
     * @inheritdoc
     */
    static $sidebars = [];

    /**
     * @inheritdoc
     */
    private static $defaults = [
        'type' => '',
        'attrs' => [],
        'class' => '',
        'show_title' => true,
        'title_tag' => 'h3',
        'is_list' => true,
        'visibility' => '', // empty|s|m|l|xl
        'style' => '', // empty|card-default|card-primary|card-secondary|card-hover
        'title_style' => '', // empty|heading-primary|h1|h2|h3|h4|h5|h6
        'title_decoration' => '', // empty|divider|bullet|line
        'text_align' => '', // empty|left|center|right|justify
        'text_align_breakpoint' => '', // empty|s|m|l|xl
        'text_align_fallback' => '', // empty|left|center|right|justify,
        'width' => '', // empty|1-5|1-4|1-3|2-5|1-2|1-1'
        'maxwidth' => '', // empty|small|medium|large|xlarge|xxlarge'
        'maxwidth_align' => false, // false|true
        'list_style' => '', // empty|divider,
        'link_style' => '', // empty|muted,
        'menu_style' => 'nav', // nav|subnav
        'items' => []
    ];

    /**
     * @inheritdoc
     */
    public $icons = [];

    /**
     * @inheritdoc
     */
    public $site = [];

    /**
     * @inheritdoc
     */
    public $logo = [];

    /**
     * @inheritdoc
     */
    public $header = [];

    /**
     * @inheritdoc
     */
    public $navbar = [];

    /**
     * @inheritdoc
     */
    public $mobile = [];

    /**
     * @inheritdoc
     */
    public $top = [];

    /**
     * @inheritdoc
     */
    public $sidebar = [];

    /**
     * @inheritdoc
     */
    public $bottom = [];

    /**
     * @inheritdoc
     */
    public $footer = [];

    /**
     * @inheritdoc
     */
    public static function onLoad()
    {
        self::registerTranslation('theme*', static::staticBasePath() . '/messages', [
            'theme' => 'theme.php'
        ]);
    }
    
    public function init()
    {
        // Merge icons settings
        $this->icons = array_merge([
            'favicon' => '',
            'touchicon' => ''
        ], $this->icons);
        // Merge site settings
        $this->site = array_merge([
            'layout' => 'full',
            'boxed_alignment' => 1,
            'boxed_padding' => '',
            'boxed_media' => '',
            'toolbar_fullwidth' => '',
            'toolbar_center' => '',
            'breadcrumbs' => ''
        ], $this->site);
        // Merge logo settings
        $this->logo = array_merge([
            'logo' => 'center',
            'text' => '',
            'image' => '',
            'image_width' => '',
            'image_height' => '',
            'image_inverse' => '',
            'image_mobile' => '',
            'image_mobile_width' => '',
            'image_mobile_height' => ''
        ], $this->logo);
        // Merge header settings
        $this->header = array_merge([
            'layout' => 'horizontal-right',
            'fullwidth' => '',
            'logo_center' => '',
            'logo_padding_remove' => '',
            'search' => '',
            'search_style' => '',
            'social' => '',
            'social_target' => '',
            'social_style' => ''
        ], $this->header);
        // Merge navbar settings
        $this->navbar = array_merge([
            'sticky' => '',
            'dropdown_align' => 'left',
            'dropdown_boundary' => '',
            'dropdown_click' => '',
            'dropbar' => '',
            'toggle_text' => '',
            'toggle_menu_style' => 'default',
            'toggle_menu_center' => '',
            'offcanvas_mode' => 'slide',
            'offcanvas_overlay' => '',
            'content' => ''
        ], $this->navbar);
        // Merge mobile settings
        $this->mobile = array_merge([
            'breakpoint' => 'm',
            'logo' => '',
            'logo_padding_remove' => '',
            'logo_description' => '',
            'search' => 'right',
            'toggle' => 'left',
            'toggle_text' => '',
            'menu_style' => 'default',
            'menu_center' => '',
            'animation' => 'offcanvas',
            'menu_center_vertical' => '',
            'offcanvas_mode' => 'slide',
            'offcanvas_flip' => '',
            'dropdown' => 'slide'
        ], $this->mobile);
        // Merge top settings
        $this->top = array_merge([
            'style' => 'default',
            'overlap' => '',
            'image' => '',
            'image_width' => '',
            'image_height' => '',
            'image_size' => '',
            'image_position' => 'center-center',
            'image_fixed' => '',
            'image_visibility' => '',
            'video' => '',
            'video_width' => '',
            'video_height' => '',
            'media_background' => '',
            'media_blend_mode' => '',
            'media_overlay' => '',
            'preserve_color' => '',
            'text_color' => '',
            'width' => 'default',
            'height' => '',
            'padding' => '',
            'padding_remove_top' => '',
            'padding_remove_bottom' => '',
            'header_transparent' => '',
            'header_transparent_noplaceholder' => '',
            'grid_gutter' => '',
            'grid_divider' => '',
            'vertical_align' => '',
            'match' => '',
            'breakpoint' => 'm'
        ], $this->top);
        // Merge sidebar settings
        $this->sidebar = array_merge([
            'width' => '1-4',
            'min_width' => '200',
            'breakpoint' => 'm',
            'first' => 0,
            'gutter' => '',
            'divider' => 0,
            'content' => ''
        ], $this->sidebar);
        // Merge bottom settings
        $this->bottom = array_merge([
            'style' => 'default',
            'overlap' => '',
            'image' => '',
            'video' => '',
            'image_width' => '',
            'image_height' => '',
            'image_size' => '',
            'image_position' => 'center-center',
            'image_fixed' => '',
            'image_visibility' => '',
            'video_width' => '',
            'video_height' => '',
            'media_background' => '',
            'media_blend_mode' => '',
            'media_overlay' => '',
            'preserve_color' => '',
            'text_color' => '',
            'width' => 'default',
            'height' => '',
            'padding' => '',
            'padding_remove_top' => '',
            'padding_remove_bottom' => '',
            'grid_gutter' => '',
            'grid_divider' => '',
            'vertical_align' => '',
            'match' => '',
            'breakpoint' => 'm'
        ], $this->bottom);
        // Merge footer settings
        $this->footer = array_merge([
            'content' => ''
        ], $this->footer);

        self::$configs = ArrayHelper::merge(self::$configs, [
            'icons' => $this->icons,
            'site' => $this->site,
            'logo' => $this->logo,
            'header' => $this->header,
            'navbar' => $this->navbar,
            'mobile' => $this->mobile,
            'top' => $this->top,
            'sidebar' => $this->sidebar,
            'bottom' => $this->bottom,
            'footer' => $this->footer
        ]);
    }
    
    /**
     * Translations
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('theme', $message, $params);
    }

    // ------------------------------------------------------------------------

    /**
     * Set config value
     *
     * @param string $config
     * @param string $element
     * @param string $value
     */
    public static function setConfig($config = "", $element = "", $value = "")
    {
        if($config)
        {
            if($element && $value)
            {
                self::$configs[$config][$element] = $value;
            }
            else
            {
                self::$configs[$config] = $element;
            }
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Get & Set sidebar content
     *
     * @param string $sidebar
     * @param string $content
     * @return bool|mixed
     */
    public static function sidebar($sidebar = "", $content = "")
    {
        $explode = explode(':', $sidebar);
        $style = "";
        if(count($explode) > 1) {
            $sidebar = $explode[0];
            $style = $explode[1];
        }

        if($content) {
            if(is_array($content)) {
                $defaults = array_merge(self::$defaults, $content);
                $items = $defaults['items'];
                unset($defaults['items']);
                // Set parameters
                $params = [];
                $params['style'] = $style;
                $params['defaults'] = $defaults;
                $params['items'] = $items;
                $params['name'] = $sidebar;
                $params['configs'] = self::$configs;
                $params['sidebars'] = self::$sidebars;
                // Get content
                $content = self::view('templates/position', $params);
            }
            self::$sidebars[$sidebar] = $content;

            return true;
        }
        else
        {
            return Module::element($sidebar, self::$sidebars, '');
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Get config as array or config element
     *
     * @param string $config
     * @param string $element
     * @return mixed
     */
    public static function getConfig($config = "", $element = "")
    {
        if($element)
        {
            return Module::element($element, Module::element($config, self::$configs, []), "");
        }
        else
        {
            return Module::element($config, self::$configs, []);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Render view file
     *
     * @param string $template
     * @param array $params
     * @return mixed|string
     */
    public static function render($template = "", $params = [])
    {
        $explode = explode(':', $template);

        if(count($explode)) $template = $explode[0];

        if(!$template) $template = 'index';

        return Yii::$app->view->renderFile(self::viewPath($template), $params);
    }

    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public static function viewPath($template = "")
    {
        $template = $template ? $template . '.php' : '';
        return  dirname(__DIR__) . '/src/views/' . $template;
    }

    // ------------------------------------------------------------------------

    /**
     * Element
     *
     * Lets you determine whether an array index is set and whether it has a value.
     * If the element is empty it returns NULL (or whatever you specify as the default value.)
     *
     * @param	string
     * @param	array
     * @param	mixed
     * @return	mixed	depends on what the array contains
     */
    public static function element($item, array $array, $default = NULL)
    {
        return array_key_exists($item, $array) ? $array[$item] : $default;
    }
}
