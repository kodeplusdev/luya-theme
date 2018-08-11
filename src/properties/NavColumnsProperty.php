<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Columns property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavColumnsProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navColumns';
    }

    public function label()
    {
        return Module::t('Navigation: Split the dropdown into columns.');
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
            ['value' => 1, 'label' => 1],
            ['value' => 2, 'label' => 2],
            ['value' => 3, 'label' => 3],
            ['value' => 4, 'label' => 4],
            ['value' => 5, 'label' => 5]
        ];
    }
}