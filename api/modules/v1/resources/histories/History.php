<?php

namespace api\modules\v1\resources\histories;

/**
 * @SWG\Definition(
 *      definition="History",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="year",
 *          type="string",
 *          description="History item year",
 *          example="2012 year"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          type="string",
 *          description="History item description",
 *          example="President"
 *      ),
 * )
 */
class History extends \common\modules\histories\models\History
{

    public function fields()
    {
        return [
            'id',
            'year' => function(History $model)
            {
                return $model->getYearPrepared();
            },
            'description',
        ];
    }

}
