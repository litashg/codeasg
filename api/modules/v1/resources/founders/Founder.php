<?php

namespace api\modules\v1\resources\founders;

/**
 * @SWG\Definition(
 *      definition="Founder",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="fullName",
 *          type="string",
 *          description="Founder Full name",
 *          example="Viniamin Rozenberg"
 *      ),
 *      @SWG\Property(
 *          property="position",
 *          type="string",
 *          description="Position",
 *          example="President"
 *      ),
 *      @SWG\Property(
 *          property="quote",
 *          type="string",
 *          description="Quote",
 *          example="Quote text"
 *      ),
 *      @SWG\Property(
 *          property="linkedInLink",
 *          type="string",
 *          description="LinkedIn link",
 *          example="https://www.linkedin.com"
 *      ),
 *      @SWG\Property(
 *          property="facebookLink",
 *          type="string",
 *          description="Facebook link",
 *          example="https://www.facebook.com"
 *      ),
 *      @SWG\Property(
 *          property="picture",
 *          type="object",
 *          ref="$/definitions/Picture",
 *         ),
 *      ),
 * )
 */
class Founder extends \common\modules\founders\models\Founder
{

    public function fields()
    {
        return [
            'id',
            'fullName',
            'position',
            'quote',
            'linkedInLink',
            'facebookLink',
            'picture' => function (Founder $model) {
                return [
                    'images' => [
                        'original' => $model->getPhoto(),
                        'large' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getPhotoPath(),
                        ], true),
                        'desktop' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getPhotoPath(),
                        ], true),
                        'tablet' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getPhotoPath(),
                        ], true),
                        'mobile' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getPhotoPath(),
                        ], true),
                    ],
                    'title' => $model->getPhotoTitle(),
                    'alt' => $model->getPhotoAlt(),
                ];
            },
        ];
    }


}
