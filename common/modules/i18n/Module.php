<?php

namespace common\modules\i18n;

use common\modules\i18n\models\Lang;

/**
 * Class Module
 *
 * @package common\modules\i18n
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'common\modules\i18n\controllers';

    /**
     * @param \yii\i18n\MissingTranslationEvent $event
     */
    public static function missingTranslation($event)
    {
        // do something with missing translation
    }

    public function getLangList(): array
    {
        return Lang::getList(true);
    }

    public static function getDefaultLanguage()
    {
        return 'en';
    }

    public static function getAvailableLocales()
    {
        return Lang::getList(true);
    }

}
