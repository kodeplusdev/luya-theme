<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Justify property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavJustifyProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navJustify';
    }

    public function label()
    {
        return Module::t('Navigation: Width');
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