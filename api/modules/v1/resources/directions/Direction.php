<?php

namespace api\modules\v1\resources\directions;

use api\modules\v1\resources\directions\Metric as DirectionMetric;
use api\modules\v1\resources\metrics\Metric;


use api\modules\v1\resources\content\Content;

/**
 * @SWG\Definition(
 *      definition="Direction",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="slug",
 *          type="string",
 *          description="Direction slug",
 *          example="napravlenie-distribucii"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Direction title",
 *          example="Distribution Direction"
 *      ),
 *      @SWG\Property(
 *          property="picture",
 *          type="object",
 *          ref="#/definitions/Picture",
 *      ),
 *      @SWG\Property(
 *          property="icon",
 *          type="object",
 *          ref="#/definitions/Image",
 *      ),
 *      @SWG\Property(
 *          property="companies",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/DirectionCompany"),
 *      ),
 *      @SWG\Property(
 *          property="achievements",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/Achievement"),
 *      ),
 *      @SWG\Property(
 *          property="chartsData",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/ChartsDataAchievements"),
 *      ),
 *      @SWG\Property(
 *          property="contentTitle",
 *          type="string",
 *          description="Content title",
 *          example="Agricultural production"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          type="string",
 *          enum={"accordion","content"},
 *          example="content"
 *      ),
 *       @SWG\Property(
 *          property="content",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/Content"),
 *      ),
 *      @SWG\Property(
 *          property="seo",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/Seo"),
 *      )
 * )
 *
 * @SWG\Definition(
 *      definition="ChartsDataAchievements",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Achievement title",
 *          example="Profit"
 *      ),
 *      @SWG\Property(
 *          property="items",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/ChartsDataAchievementsItems"),
 *      )
 * )
 *
 * @SWG\Definition(
 *      definition="ChartsDataAchievementsItems",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="prefix",
 *          type="string",
 *          description="Achievement prefix",
 *          example="$"
 *      ),
 *      @SWG\Property(
 *          property="suffix",
 *          type="string",
 *          description="Achievement suffix",
 *          example="MM"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Achievement year",
 *          example="2017"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          type="integer",
 *          description="Achievement value",
 *          example=30600
 *      )
 * )
 */
class Direction extends \common\modules\directions\models\Direction
{

    /**
     * @return string
     */
    protected function getContentTypeName(): string
    {
        $types = [
            self::CONTENT_TYPE_CONTENT => 'content',
            self::CONTENT_TYPE_ACCORDION => 'accordion',
        ];

        return $types[$this->content_type] ?? "";
    }

    public function fields()
    {

        return [
            'id',
            'title',
            'slug',
            'contentTitle',
            'contentType' => function (Direction $model) {
                return $model->getContentTypeName();
            },
            'picture' => function (Direction $model) {
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
            'icon' => function (Direction $model) {
                return [
                    'image' => $model->getIcon(),
                    'title' => $model->getIconTitle(),
                    'alt' => $model->getIconAlt(),
                ];
            },
            'companies' => function (Direction $model) {
                return Company::find()
                    ->where(['direction_id' => $model->getId()])
                    ->orderBy(['order' => SORT_ASC])
                    ->all();
            },
            'achievements' => function (Direction $model) {
                return Achievement::find()
                    ->where(['direction_id' => $model->getId()])
                    ->orderBy(['order' => SORT_ASC])
                    ->active()
                    ->all();
            },
            'chartsData' => function() {
                return $this->getChartsData();
            },
            'content' => function (Direction $model) {
                return Content::find()
                    ->where(['direction_id' => $model->getId()])
                    ->orderBy(['order' => SORT_ASC])
                    ->all();
            },
            'seo' => function (Direction $model) {
                return [
                    'meta_title' => (isset($model->seo)) ? $model->seo->getMetaTitle(): null,
                ];
            }
        ];
    }

    /**
     * @return array
     */
    public function getChartsData(): array
    {
        $achievements = Achievement::find()
            ->joinWith('achievementI18n')
            ->orderBy(['title' => SORT_DESC])
            ->limit(5)
            ->indexBy('id')
            ->active()
            ->all();

        $metrics = Metric::find()
            ->type(Metric::TYPE_DIRECTION)
            ->all();

        $directionMetrics = DirectionMetric::find()->all();
        $directionMetricsArray = [];

        /** @var \common\modules\directions\models\Metric $directionMetric */
        foreach ($directionMetrics as $directionMetric) {
            $directionMetricsArray[$directionMetric->getDirectionAchievementId()][$directionMetric->getMetricId()] = $directionMetric;
        }

        $data = [];

        /** @var Metric $metric */
        foreach ($metrics as $metric) {
            $items = [];

            /** @var Achievement $achievement */
            foreach ($achievements as $achievement) {
                /** @var DirectionMetric $currentDirectionMetric */

                $currentDirectionMetric = $directionMetricsArray[$achievement->getId()][$metric->getId()] ?? null;
                $items[] = [
                    'id' => $achievement->getId(),
                    'title' => $achievement->getTitle(),
                    'prefix' => ($currentDirectionMetric) ? $currentDirectionMetric->getPrefix() : null,
                    'suffix' => ($currentDirectionMetric) ? $currentDirectionMetric->getSuffix() : null,
                    'value' => ($currentDirectionMetric) ? $currentDirectionMetric->getValue() : null
                ];
            }
            $data[] = [
                'id' => $metric->getId(),
                'title' => $metric->getTitle(),
                'items' => $items,
            ];
        }
        return $data;
    }
}
