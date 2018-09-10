<?php

namespace api\modules\v1\resources\maps;

/**
 * @SWG\Definition(
 *      definition="Control",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="key",
 *          type="string",
 *          description="Unique string key",
 *          example="representation"
 *      ),
 *      @SWG\Property(
 *          property="icon",
 *          type="string",
 *          description="Icon",
 *          example="rect"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Control title",
 *          example="Distribution offices"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          type="string",
 *          description="Control description",
 *          example="26 branches in Ukraine"
 *      ),
 *      @SWG\Property(
 *          property="plans",
 *          type="string",
 *          description="Control plans",
 *          example="+2 in the plans"
 *      ),
 *      @SWG\Property(
 *          property="map",
 *          type="string",
 *          description="Control map",
 *          example="default"
 *      ),
 * )
 *
 * @property string $statusName
 */
class Control extends \common\modules\maps\models\Control
{

    public function fields()
    {
        return [
            'id',
            'key',
            'icon',
            'title',
            'description',
            'plans',
            'map',
        ];
    }
}
