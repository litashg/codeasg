<?php

namespace api\modules\v1\resources\contacts;

/**
 * @SWG\Definition(
 *      definition="Contact",
 *      @SWG\Property(
 *          property="companyName",
 *          type="string",
 *          description="Company name",
 *          example="Company name"
 *      ),

 *      @SWG\Property(
 *          property="phone",
 *          description="Phone array",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/Phone")
 *      ),
 *      @SWG\Property(
 *          property="address",
 *          description="Address array",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/Address")
 *      ),
 *      @SWG\Property(
 *          property="email",
 *          description="Email array",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/Email")
 *      ),
 *      @SWG\Property(
 *          property="position",
 *          type="object",
 *          description="Map position coordinates",
 *          ref="$/definitions/Position",
 *      ),
 * )
 * @SWG\Definition(
 *      definition="Position",
 *      @SWG\Property(
 *          property="longitude",
 *          type="float",
 *          description="Longitude",
 *          example=35.135959
 *      ),
 *      @SWG\Property(
 *           property="latitude",
 *           type="float",
 *           description="Latitude",
 *           example=33.353533
 *      ),
 * )
 * @SWG\Definition(
 *      definition="Phone",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          type="string",
 *          description="phone value ",
 *          example="+35943333341",
 *      )
 * )
 * @SWG\Definition(
 *      definition="Email",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          type="string",
 *          description="email value",
 *          example="test@user.com",
 *      )
 * )
 * @SWG\Definition(
 *      definition="Address",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          type="string",
 *          description="address value",
 *          example="Address line 1",
 *      )
 * )
 */

class Contact extends \common\modules\pages\models\Contact
{

    public function fields()
    {
        return [
            'companyName',
            'phone' => function($model) {
                return $model->getArrayOf('phone');
            },
            'address' => function($model) {
                return $model->getAddressArr();
            },
            'email' => function($model) {
                return $model->getArrayOf('email');
            },
            'position' => function($model) {
                return [
                    'longitude' => $model->getLongitude(),
                    'latitude' => $model->getLatitude(),
                ];
            }
        ];
    }


}
