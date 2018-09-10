<?php

namespace api\modules\v1\resources\pages;

use api\modules\v1\resources\audit\Year;
use api\modules\v1\resources\audit\Metric as AuditMetric;
use api\modules\v1\resources\metrics\Metric;
use yii\helpers\ArrayHelper;

/**
 * @SWG\Response(
 *      response="AuditPage",
 *      description="The AuditPage response",
 *      @SWG\Schema(
 *          ref="$/definitions/Page",
 *          @SWG\Property(
 *              property="footnote",
 *              type="string",
 *              description="Footnote text",
 *              example="Lorem ipsum dolor sit amet"
 *          ),
 *          @SWG\Property(
 *              property="footnoteImage",
 *              type="object",
 *              ref="#/definitions/FootnoteImageAudit"
 *          ),
 *          @SWG\Property(
 *              property="years",
 *              description="Last 5 years in descending order",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Year"),
 *          ),
 *          @SWG\Property(
 *              property="chartsData",
 *              description="Metrics by last 5 years",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/ChartsData"),
 *          ),
 *          @SWG\Property(
 *              property="seo",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Seo"),
 *          ),
 *      )
 * )
 *
 * @SWG\Definition(
 *      definition="FootnoteImageAudit",
 *      @SWG\Property(
 *          property="image",
 *          type="string",
 *          description="Footnote Logo link",
 *          example="http://storage.bkw.loc/source/1/OD1sQRyWFhKPw61si1saPEZj_JCbn51W.svg"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Footnote image title attribute",
 *          example="image title"
 *      ),
 *      @SWG\Property(
 *          property="alt",
 *          type="string",
 *          description="Footnote image alt attribute",
 *          example="image alt"
 *      ),
 * )
 *
 * @SWG\Definition(
 *      definition="ChartsData",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Metric title",
 *          example="Profit"
 *      ),
 *      @SWG\Property(
 *          property="items",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/ChartsDataMetricItems"),
 *      )
 * )
 * @SWG\Definition(
 *      definition="ChartsDataMetricItems",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=1
 *      ),
 *      @SWG\Property(
 *          property="prefix",
 *          type="string",
 *          description="Metric prefix",
 *          example="$"
 *      ),
 *      @SWG\Property(
 *          property="suffix",
 *          type="string",
 *          description="Metric suffix",
 *          example="MM"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Metric year",
 *          example="2017"
 *      ),
 *      @SWG\Property(
 *          property="value",
 *          type="integer",
 *          description="Metric value",
 *          example=30600
 *      )
 * )
 *
 * @property array $chartsData
 */
class Audit extends Page
{
    public function fields()
    {
        $fields = [
            'footnote',
            'footnoteImage' => function (Page $model) {
                return [
                    'image' => $model->getFootnoteImage(),
                    'title' => $model->getFootnoteImageTitle(),
                    'alt' => $model->getFootnoteImageAlt(),
                ];
            },
            'years' => function() {
                return Year::find()
                    ->joinWith('yearI18n')
                    ->orderBy(['title' => SORT_DESC])
                    ->limit(5)
                    ->active()
                    ->all();
            },
            'chartsData' => function() {
                return $this->getChartsData();
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
     * @return array
     */
    public function getChartsData(): array
    {
        $years = Year::find()
            ->joinWith('yearI18n')
            ->orderBy(['title' => SORT_DESC])
            ->limit(5)
            ->indexBy('id')
            ->active()
            ->all();

        $metrics = Metric::find()
            ->type(Metric::TYPE_AUDIT)
            ->all();

        $auditMetrics = AuditMetric::find()->all();
        $auditMetricsArray = [];

        /** @var \common\modules\audit\models\Metric $auditMetric */
        foreach ($auditMetrics as $auditMetric) {
            $auditMetricsArray[$auditMetric->getAuditYearId()][$auditMetric->getMetricId()] = $auditMetric;
        }

        $data = [];
        foreach ($metrics as $metric) {
            $items = [];

            /** @var Year $year */
            foreach ($years as $year) {
                /** @var AuditMetric $currentAuditMetric */
                $currentAuditMetric = $auditMetricsArray[$year->getId()][$metric->getId()] ?? new AuditMetric();

                $items[] = [
                    'id' => $year->getId(),
                    'title' => $year->getTitle(),
                    'prefix' => $currentAuditMetric->getPrefix(),
                    'suffix' => $currentAuditMetric->getSuffix(),
                    'value' => $currentAuditMetric->getValue(),
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
