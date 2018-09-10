<?php

namespace api\modules\v1\resources\maps;

/**
 * @SWG\Definition(
 *      definition="Country",
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
 *          example="ukraine"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Country title",
 *          example="Ukraine"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          type="string",
 *          description="Country status",
 *          example="active",
 *          default="inactive",
 *          enum={"active","plan","inactive"},
 *      ),
 *      @SWG\Property(
 *          property="labelPosition",
 *          type="string",
 *          description="Position Label",
 *          example="right",
 *          default="left",
 *          enum={"right","left"},
 *      ),
 *      @SWG\Property(
 *          property="coordinates",
 *          type="object",
 *          ref="$/definitions/CoordinatesMap",
 *      ),
 * )
 *
 * @SWG\Definition(
 *      definition="CoordinatesMap",
 *      @SWG\Property(
 *          property="x",
 *          type="float",
 *          description="X coordinate",
 *          example=65.23
 *      ),
 *      @SWG\Property(
 *          property="y",
 *          type="float",
 *          description="Y coordinate",
 *          example=35.45
 *      ),
 * )
 *
 * @property string $statusName
 */
class Country extends \common\modules\maps\models\Country
{
    /**
     * @return array
     */
    public static function getEnumStatuses(): array
    {
        $data = [
            self::STATUS_ACTIVE => 'active',
            self::STATUS_PLAN => 'plan',
            self::STATUS_INACTIVE => 'inactive',
        ];

        return $data;
    }

    /**
     * @return string
     */
    protected function getStatusName(): string
    {
        $statuses = [
            self::STATUS_ACTIVE => 'active',
            self::STATUS_PLAN => 'plan',
            self::STATUS_INACTIVE => 'inactive',
        ];

        return $statuses[$this->status];
    }

    public function fields()
    {
        return [
            'id',
            'key',
            'title',
            'status' => function (Country $model) {
                return $model->getStatusName();
            },
            'coordinates' => function (Country $model) {
                return [
                    'x' => $model->getCoordinateX(),
                    'y' => $model->getCoordinateY(),
                ];
            },
            'labelPosition' => function(Country $model){
                return $model->getPosition();
            },
        ];
    }
}
