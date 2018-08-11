<?php

namespace trk\theme\properties;

use trk\theme\Module;

/**
 * Navigation Anchor Title property
 *
 * @author Iskender TOTOĞLU <iskender@altivebir.com>
 */
class NavAnchorTitleProperty extends \luya\admin\base\Property
{
    public function varName()
    {
        return 'navAnchorTitle';
    }

    public function label()
    {
        return Module::t('Navigation: Anchor Title');
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