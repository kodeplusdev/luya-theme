<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Icon property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavIconProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navIcon';
    }

    public function label()
    {
        return Module::t('Navigation: Icon');
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