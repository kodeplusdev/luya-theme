<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Traget property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavTargetProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navTarget';
    }

    public function label()
    {
        return Module::t('Navigation Target');
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