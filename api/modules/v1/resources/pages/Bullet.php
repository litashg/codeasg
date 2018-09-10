<?php

namespace api\modules\v1\resources\pages;

/**
 * @SWG\Definition(
 *      definition="Bullet",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="text",
 *          type="string",
 *          description="Bullet text",
 *          example="Special something text."
 *      ),
 * )
 */
class Bullet extends \common\modules\pages\models\Bullet
{

    public function fields()
    {
        return [
            'id',
            'text',
        ];
    }
}
