<?php

namespace api\modules\v1\resources\audit;

/**
 * @SWG\Definition(
 *      definition="Year",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Year title",
 *          example="2016"
 *      ),
 *          @SWG\Property(
 *              property="metrics",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/AuditMetric"),
 *          ),
 * )
 */
class Year extends \common\modules\audit\models\Year
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
        return $this->hasMany(Metric::class, ['audit_year_id' => 'id']);
    }

}
