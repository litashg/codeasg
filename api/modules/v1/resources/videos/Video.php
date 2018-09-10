<?php

namespace api\modules\v1\resources\videos;

/**
 * @SWG\Definition(
 *      definition="Video",
 *      @SWG\Property(
 *          property="video",
 *          type="string",
 *          description="Video link",
 *          example="http://storage.bkw.loc/source/1/OD1sQRyWFhKPw61si1saPEZj_JCbn51W.mov"
 *      ),
 *      @SWG\Property(
 *          property="picture",
 *          type="object",
 *          ref="$/definitions/Picture",
 *         ),
 *      ),
 * )
 */
class Video extends \common\modules\videoBlock\models\Video
{

    public function fields()
    {
        return [
            'video' => function (Video $model) {
                return $model->getVideo();
            },
            'picture' => function (Video $model) {
                return [
                    'images' => [
                        'original' => $model->getImage(),
                        'large' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getImagePath(),
                        ], true),
                        'desktop' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getImagePath(),
                        ], true),
                        'tablet' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getImagePath(),
                        ], true),
                        'mobile' => \Yii::$app->glide->createSignedUrl([
                            'glide/index',
                            'path' => $model->getImagePath(),
                        ], true),
                    ],
                    'title' => $model->getImageTitle(),
                    'alt' => $model->getImageAlt(),
                ];
            },
        ];
    }


}
