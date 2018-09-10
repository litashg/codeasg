<?php

namespace api\modules\v1\resources\pages;

use yii\helpers\ArrayHelper;

/**
 * @SWG\Response(
 *      response="StructurePage",
 *      description="The StructurePage response",
 *      @SWG\Schema(
 *          ref="$/definitions/Page",
 *          @SWG\Property(
 *              property="directions",
 *              description="Directions list",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Direction"),
 *          )
 *      )
 * )
 *
 */
class Structure extends Page
{

    public function fields()
    {

        $fields = [
            'directions' => function() {
                return \api\modules\v1\resources\directions\Direction::find()
                    ->joinWith('directionI18n')
                    ->orderBy(['order' => SORT_ASC])
                    ->limit(5)
                    ->all();
            }
        ];

        return ArrayHelper::merge(parent::fields(), $fields);
    }
}
