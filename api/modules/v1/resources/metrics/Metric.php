<?php

namespace api\modules\v1\resources\metrics;

/**
 * @SWG\Definition(
 *      definition="Metric",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Metric title",
 *          example="Credit of trust"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          type="string",
 *          description="Metric text",
 *          example="Number of funds entrusted to the companies of the BKW group by partner banks."
 *      ),
 * )
 */
class Metric extends \common\modules\metrics\models\Metric
{

    public function fields()
    {
        return [
            'id',
            'title',
            'description',
        ];
    }
}
