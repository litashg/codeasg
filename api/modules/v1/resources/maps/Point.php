<?php

namespace api\modules\v1\resources\maps;

/**
 * @SWG\Definition(
 *      definition="Point",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Point title",
 *          example="Special title"
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          type="string",
 *          description="Point address",
 *          example="Kiev, Gorkogo 23"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          type="string",
 *          description="Point description",
 *          example="Special Kiev point"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          type="string",
 *          description="Point type",
 *          example="production",
 *          default="representation",
 *          enum={"representation","production"},
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          type="string",
 *          description="Point status",
 *          example="active",
 *          default="active",
 *          enum={"active","plan"},
 *      ),
 *      @SWG\Property(
 *          property="coordinates",
 *          type="object",
 *          ref="$/definitions/Coordinates",
 *         ),
 *      ),
 * )
 *
 * @SWG\Definition(
 *      definition="Coordinates",
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
 *
 * @property string $statusName
 * @property string $typeName
 */
class Point extends \common\modules\maps\models\Point
{

    /**
     * @return array
     */
    public static function getEnumTypes(): array
    {
        $data = [
            self::TYPE_REPRESENTATION => 'representation',
            self::TYPE_PRODUCTION => 'production',
        ];

        return $data;
    }

    /**
     * @return array
     */
    public static function getEnumStatuses(): array
    {
        $data = [
            self::STATUS_ACTIVE => 'active',
            self::STATUS_PLAN => 'plan',
        ];

        return $data;
    }

    /**
     * @return string
     */
    protected function getTypeName(): string
    {
        $types = [
            self::TYPE_REPRESENTATION => 'representation',
            self::TYPE_PRODUCTION => 'production',
        ];

        return $types[$this->type];
    }

    /**
     * @return string
     */
    protected function getStatusName(): string
    {
        $statuses = self::getEnumStatuses();

        return $statuses[$this->status];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'address',
            'description',
            'type' => function (Point $model) {
                return $model->getTypeName();
            },
            'status' => function (Point $model) {
                return $model->getStatusName();
            },
            'coordinates' => function (Point $model) {
                return [
                    'x' => $model->getCoordinateX(),
                    'y' => $model->getCoordinateY(),
                ];
            },
        ];
    }

}
