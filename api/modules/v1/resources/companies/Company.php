<?php

namespace api\modules\v1\resources\companies;

/**
 * @SWG\Definition(
 *      definition="Company",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="logo",
 *          type="string",
 *          description="Company Logo link",
 *          example="http://storage.bkw.loc/source/1/OD1sQRyWFhKPw61si1saPEZj_JCbn51W.svg"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Image title attribute",
 *          example="image title"
 *      ),
 *      @SWG\Property(
 *          property="alt",
 *          type="string",
 *          description="Image alt attribute",
 *          example="image alt"
 *      ),
 * )
 */

class Company extends \common\modules\companies\models\Company
{

    public function fields()
    {
        return [
            'id',
            'logo' => function (Company $model) {
                return $model->getLogo();
            },
            'title' => function (Company $model) {
                return $model->getLogoTitle();
            },
            'alt' => function (Company $model) {
                return $model->getLogoAlt();
            },
        ];
    }


}
