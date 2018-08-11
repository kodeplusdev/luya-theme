<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Subtitle property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavSubtitleProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navSubtitle';
    }

    public function label()
    {
        return Module::t('Navigation Subtitle');
    }

    public function defaultValue()
    {
        return '';
    }

    public function type()
    {
        return self::TYPE_TEXT;
    }
}