<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Divider property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavDividerProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navDivider';
    }

    public function label()
    {
        return Module::t('Navigation: Divider');
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