<?php

namespace backend\modules\translation\traits;

use common\modules\i18n\Module;

trait ModuleTrait
{

    /**
     * @return array
     */
    public function getLanguages()
    {
        return Module::getAvailableLocales();
    }

}