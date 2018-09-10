<?php

namespace api\modules\v1\resources\directions;

/**
 * @SWG\Definition(
 *      definition="Achievement",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Achievement title",
 *          example="2016"
 *      ),
 *      @SWG\Property(
 *          property="metrics",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/DirectionMetric"),
 *      ),
 * )
 *
 * @property mixed $metrics
 */
class Achievement extends \common\modules\directions\models\Achievement
{

    public function fields()
    {
        return [
            'id',
            'title',
            'metrics',
        ];
    }

    public function getMetrics()
    {
        return $this->hasMany(Metric::class, ['direction_achievement_id' => 'id']);
    }

}
