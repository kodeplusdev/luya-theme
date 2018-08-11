<?php

namespace trk\theme;

use luya\base\CoreModuleInterface;

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
