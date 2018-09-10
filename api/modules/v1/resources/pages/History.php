<?php

namespace api\modules\v1\resources\pages;

use yii\helpers\ArrayHelper;

/**
 * @SWG\Response(
 *      response="HistoryPage",
 *      description="The HistoryPage response",
 *      @SWG\Schema(
 *          ref="$/definitions/Page",
 *          @SWG\Property(
 *              property="histories",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/History"),
 *          ),
 *          @SWG\Property(
 *              property="seo",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Seo"),
 *          ),
 *      )
 * )
 *
 * @property \yii\db\ActiveQuery $histories
 */
class History extends Page
{

    public function fields()
    {

        $fields = [
            'histories' => function($model) {
                return \api\modules\v1\resources\histories\History::find()
                    ->orderBy(['year' => SORT_ASC])
                    ->all();
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
