<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Image Class property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavImageClassProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navImageClass';
    }

    public function label()
    {
        return Module::t('Navigation: Image Class');
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