<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Class property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavTypeProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navType';
    }

    public function label()
    {
        return Module::t('Navigation: Type');
    }

    public function defaultValue()
    {
        return '';
    }

    public function type()
    {
        return self::TYPE_SELECT;
    }

    public function options()
    {
        return [
            ['value' => '', 'label' => Module::t('None')],
            ['value' => 'header', 'label' => Module::t('Header')]
        ];
    }
}