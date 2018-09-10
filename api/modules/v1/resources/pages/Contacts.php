<?php

namespace api\modules\v1\resources\pages;

use api\modules\v1\resources\contacts\Contact;
use yii\helpers\ArrayHelper;

/**
 * @SWG\Response(
 *      response="ContactPage",
 *      description="The ContactPage response",
 *      @SWG\Schema(
 *          ref="$/definitions/Page",
 *          @SWG\Property(
 *              property="contacts",
 *              type="object",
 *              ref="#/definitions/Contact",
 *          ),
 *          @SWG\Property(
 *              property="seo",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Seo"),
 *          ),
 *      )
 * )
 *
 */
class Contacts extends Page
{
    public function fields()
    {
        $fields = [
            'contacts' => function() {
                return Contact::find()->one();
            },
            'seo' => function (Page $model) {
                return [
                    'meta_title' => (isset($model->seo)) ? $model->seo->getMetaTitle(): null,
                ];
            }
        ];

        return ArrayHelper::merge(parent::fields(), $fields);
    }
}