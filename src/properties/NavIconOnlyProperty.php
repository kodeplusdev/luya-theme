<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Icon only property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavIconOnlyProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navIconOnly';
    }

    public function label()
    {
        return Module::t('Navigation: Icon Only');
    }

    public function defaultValue()
    {
        return '';
    }

    public function type()
    {
        return self::TYPE_CHECKBOX;
    }
}