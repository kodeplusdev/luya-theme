<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Class property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavClassProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navClass';
    }

    public function label()
    {
        return Module::t('Navigation: Class');
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