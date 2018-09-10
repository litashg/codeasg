<?php

namespace api\modules\v1\resources\languages;

use common\modules\i18n\models\Lang;

/**
 * @SWG\Definition(
 *      definition="Language",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 * )
 */
class Language extends Lang
{

    public function fields()
    {
        return [
            'id',
            'code',
            'locale',
            'name',
            'url' => function(Lang $model) {

                if($model->getLocale() == \Yii::$app->sourceLanguage) {
                    return "/";
                }

                return "/{$model->getCode()}";
            }
        ];
    }
}
