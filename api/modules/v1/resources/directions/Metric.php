<?php

namespace api\modules\v1\resources\directions;

/**
 * @SWG\Definition(
 *      definition="DirectionMetric",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          type="string",
 *          description="Metric value",
 *          example="23657"
 *      ),
 *      @SWG\Property(
 *          property="prefix",
 *          type="string",
 *          description="Metric text before value",
 *          example="$"
 *      ),
 *      @SWG\Property(
 *          property="suffix",
 *          type="string",
 *          description="Metric text after value",
 *          example="MM"
 *      ),
 *      @SWG\Property(
 *          property="info",
 *          type="object",
 *          ref="$/definitions/Metric",
 *         ),
 *      ),
 * )
 */
class Metric extends \common\modules\directions\models\Metric
{

    public function fields()
    {
        return [
            'id',
            'prefix',
            'value',
            'suffix',
            'info',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfo()
    {
        return $this->hasOne(\api\modules\v1\resources\metrics\Metric::class, ['id' => 'metric_id']);
    }

}
