<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $filterModel \common\modules\news\models\search\NewsSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('backend', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="news-list">

    <div class="box-body text-right">
        <?= \yii\helpers\Html::a(
            '<i class="fa fa-plus"></i> ' . Yii::t('backend', 'New entity'),
            ['create'],
            ['class' => 'btn btn-primary btn-sm']
        ); ?>
    </div>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $filterModel,
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'columns' => [
                    [
                        'attribute' => 'id',
                        'options' => ['width' => '8%'],
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'published_at',
                        'format' => ['date', 'php:Y-m-d'],
                    ],
                    [
                        'class' => 'lav45\translate\grid\ActionColumn',
                        'languages' => \common\modules\i18n\models\Lang::getList(),
                    ],
                    [
                        'class' => \backend\grid\ActionColumn::class,
                        'template' => '{link}',
                        'buttons' => [
                            'link' => function ($url, $model) {
                                $url = Yii::$app->urlManagerFrontend->createUrl(
                                    [
                                        '/article/view',
                                        'slug' => $model->getSlug(),
                                    ]
                                );
                                $title = Yii::t('backend', 'Go over');

                                return Html::a(
                                    '<i class="fa fa-external-link" aria-hidden="true"></i> ' . $title,
                                    Yii::$app->urlManagerFrontend->hostInfo . $url,
                                    [
                                        'title' => $title,
                                        'class' => 'btn btn-success btn-xs',
                                        'target' => '_blank',
                                    ]
                                );
                            },
                        ],
                    ],
                    [
                        'class' => \backend\grid\ActionColumn::class,
                        'template' => '{update} {delete}',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>