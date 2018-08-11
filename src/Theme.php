<?php

namespace trk\theme;

use Yii;

class Theme {

    /**
     * Regex for image files
     */
    const REGEX_IMAGE = '#\.(gif|png|jpe?g|svg)$#';

    /**
     * Regex for video files
     */
    const REGEX_VIDEO = '#\.(mp4|ogv|webm)$#';

    /**
     * Regex for vimeo
     */
    const REGEX_VIMEO = '#(?:player\.)?vimeo\.com(?:/video)?/(\d+)#i';

    /**
     * Regex for youtube
     */
    const REGEX_YOUTUBE = '#(?:youtube(-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})#i';

    /**
     * @var Theme
     */
    private static $instance;

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
        'footer' => [],
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

    // ------------------------------------------------------------------------

    /**
     * Constructs a new theme.
     */
    public function __construct()
    {
        $this->init();
    }

    // ------------------------------------------------------------------------

    /**
     * @return Theme
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    // ------------------------------------------------------------------------

    /**
     * Initializer
     */
    public function init()
    {
        // Set theme variables
        $this->setConfigs();
    }

    // ------------------------------------------------------------------------

    /**
     * Set configs
     */
    private function setConfigs() {

        $Module = Module::getInstance();
        self::$configs = array_merge(self::$configs, [
            'appUrl' => Yii::$app->request->baseUrl,
            'page' => Yii::$app->menu->current,
            'language' => Yii::$app->composition->language,
            'icons' => $Module->icons,
            'site' => $Module->site,
            'logo' => $Module->logo,
            'header' => $Module->header,
            'navbar' => $Module->navbar,
            'mobile' => $Module->mobile,
            'top' => $Module->top,
            'sidebar' => $Module->sidebar,
            'bottom' => $Module->bottom,
            'footer' => $Module->footer,
        ]);
    }

    // ------------------------------------------------------------------------

    /**
     * Get config as array or config element
     *
     * @param string $config
     * @param string $element
     * @return mixed
     */
    public static function get($config = "", $element = "")
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
     * Set config value
     *
     * @param string $config
     * @param string $element
     * @param string $value
     */
    public static function set($config = "", $element = "", $value = "")
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
     * Renders an image tag.
     *
     * @param  array|string $url
     * @param  array        $attrs
     * @return string
     */
    public static function image($url, array $attrs = [])
    {
        $url = (array) $url;
        $path = array_shift($url);
        $params = $url ? '#' . http_build_query(array_map(function ($value) {
                return is_array($value) ? implode(',', $value) : $value;
            }, $url), '', '&') : '';

        if (empty($attrs['alt'])) {
            $attrs['alt'] = true;
        }

        return "<img" . self::attrs(['src' => $path . $params], $attrs) . ">";
    }

    // ------------------------------------------------------------------------

    /**
     * is the link image ?
     *
     * @param $link
     * @return bool
     */
    public static function isImage($link) {
        return $link && preg_match(self::REGEX_IMAGE, $link, $matches) ? $matches[1] : false;
    }

    // ------------------------------------------------------------------------

    /**
     * is the link video ?
     *
     * @param $link
     * @return bool
     */
    public static function isVideo($link) {
        return $link && preg_match(self::REGEX_VIDEO, $link, $matches) ? $matches[1] : false;
    }

    // ------------------------------------------------------------------------

    /**
     * is the iframe url ?
     *
     * @param $link
     * @param array $params
     * @param bool $defaults
     * @return string
     */
    public static function iframeVideo($link, $params = [], $defaults = true) {
        $query = parse_url($link, PHP_URL_QUERY);

        if ($query) {
            parse_str($query, $_params);
            $params = array_merge($_params, $params);
        }

        if (preg_match(self::REGEX_VIMEO, $link, $matches)) {
            return self::url("https://player.vimeo.com/video/{$matches[1]}", $defaults ? array_merge([
                'loop' => 1,
                'autoplay' => 1,
                'title' => 0,
                'byline' => 0,
                'setVolume' => 0
            ], $params) : $params);
        }

        if (preg_match(self::REGEX_YOUTUBE, $link, $matches)) {

            if (!empty($params['loop'])) {
                $params['playlist'] = $matches[2];
            }

            if (empty($params['controls'])) {
                $params['disablekb'] = 1;
            }

            return self::url("https://www.youtube{$matches[1]}.com/embed/{$matches[2]}", $defaults ? array_merge([
                'rel' => 0,
                'loop' => 1,
                'playlist' => $matches[2],
                'autoplay' => 1,
                'controls' => 0,
                'showinfo' => 0,
                'iv_load_policy' => 3,
                'modestbranding' => 1,
                'wmode' => 'transparent',
                'playsinline' => 1
            ], $params) : $params);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Url Generator
     *
     * @param $path
     * @param array $parameters
     * @return string
     */
    public static function url($path, array $parameters = []) {
        if(count($parameters)) $path .= '?' . http_build_query($parameters);
        return $path;
    }

    // ------------------------------------------------------------------------

    /**
     * Renders tag attributes.
     *
     * @param  array $attrs
     * @return string
     */
    public static function attrs(array $attrs)
    {
        $output = [];

        if (count($args = func_get_args()) > 1) {
            $attrs = call_user_func_array('array_merge_recursive', $args);
        }

        foreach ($attrs as $key => $value) {

            if (is_array($value)) {
                $value = implode(' ', array_filter($value));
            }

            if (empty($value) && !is_numeric($value)) {
                continue;
            }

            if (is_numeric($key)) {
                $output[] = $value;
            } elseif ($value === true) {
                $output[] = $key;
            } elseif ($value !== '') {
                $output[] = sprintf('%s="%s"', $key, htmlspecialchars($value, ENT_COMPAT, 'UTF-8', false));
            }
        }

        return $output ? ' '.implode(' ', $output) : '';
    }

    // ------------------------------------------------------------------------

    /**
     * Get & Set sidebar content
     *
     * @param string $sidebar
     * @param string $content
     * @return mixed|string
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
                $configs = array_merge(self::$defaults, $content);
                $items = $configs['items'];
                unset($configs['items']);

                $content = self::view('templates/position', ['style' => $style, 'configs' => $configs, 'items' => $items, 'name' => $sidebar]);
            }
            self::$sidebars[$sidebar] = $content;
        }
        else
        {
            return Module::element($sidebar, self::$sidebars, '');
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
    public static function view($template = "", $params = [])
    {
        $explode = explode(':', $template);

        if(count($explode)) $template = $explode[0];

        if(!$template) $template = 'index';

        return self::getInstance()->render($template, $params);
    }


    // ------------------------------------------------------------------------

    /**
     * @inheritdoc
     */
    public function render($template = "", $params = [])
    {
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
}