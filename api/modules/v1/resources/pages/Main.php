<?php

namespace api\modules\v1\resources\pages;

use yii\helpers\ArrayHelper;

/**
 * @SWG\Response(
 *      response="MainPage",
 *      description="the MainPage response",
 *      @SWG\Schema(
 *          ref="$/definitions/Page",
 *          @SWG\Property(
 *              property="bullets",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Bullet"),
 *          ),
 *          @SWG\Property(
 *              property="video",
 *              type="object",
 *              ref="$/definitions/Video",
 *          ),
 *          @SWG\Property(
 *              property="seo",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Seo"),
 *          ),
 *      )
 * )
 *
 *
 * @property \yii\db\ActiveQuery $bullets
 */
class Main extends Page
{

    public function fields()
    {

        $fields = [
            'bullets',
            'video' => function() {
                return \api\modules\v1\resources\videos\Video::find()->one();
            },
            'seo' => function (Page $model) {
                return [
                    'meta_title' => (isset($model->seo)) ? $model->seo->getMetaTitle(): null,
                ];
            }
        ];

        return ArrayHelper::merge(parent::fields(), $fields);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBullets()
    {
        return $this->hasMany(Bullet::class, ['page_id' => 'id']);
    }


}
