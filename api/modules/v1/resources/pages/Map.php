<?php

namespace api\modules\v1\resources\pages;

use api\modules\v1\resources\maps\Control;
use api\modules\v1\resources\maps\Country;
use api\modules\v1\resources\maps\Point;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * @SWG\Response(
 *      response="MapPage",
 *      description="The MapPage response",
 *      @SWG\Schema(
 *          ref="$/definitions/Page",
 *          @SWG\Property(
 *              property="points",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Point"),
 *          ),
 *          @SWG\Property(
 *              property="countries",
 *              description="List of active&plan countries",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Country"),
 *          ),
 *          @SWG\Property(
 *              property="controls",
 *              description="List of controls",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Control"),
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
class Map extends Page
{
    public function fields()
    {
        $fields = [
            'points' => function() {
                return Point::find()
                    ->all();
            },
            'countries' => function() {
                $tableName = Country::tableName();
                return Country::find()
                    ->andWhere(new Expression("($tableName.`status` = ".Country::STATUS_ACTIVE." OR $tableName.`status` = ".Country::STATUS_PLAN.")"))
                    ->all();
            },
            'controls' =>  function() {
                return Control::find()
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
