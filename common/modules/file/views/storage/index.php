<?php

use trntv\yii\datetime\DateTimeWidget;
use yii\grid\GridView;
use yii\web\JsExpression;

/**
 * @var $this         yii\web\View
 * @var $searchModel  \common\modules\file\models\search\FileStorageItemSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $components   array
 * @var $totalSize    integer
 */

$this->title = Yii::t('backend', 'File Storage Items');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= Yii::$app->formatter->asSize($totalSize); ?></h3>

                <p><?= Yii::t('backend', 'Used size') ?></p>
            </div>
            <div class="icon">
                <i class="fa fa-database"></i>
            </div>
            <div class="small-box-footer">
                &nbsp;
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?php echo $dataProvider->totalCount ?></h3>

                <p><?php echo Yii::t('backend', 'Count') ?></p>
            </div>
            <div class="icon">
                <i class="fa fa-pie-chart"></i>
            </div>
            <div class="small-box-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>

<div class="box">
    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => [
                'class' => 'grid-view table-responsive',
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'path',
                'type',
                'size:size',
                'name',
                'upload_ip',
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                    'filter' => DateTimeWidget::widget([
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        'phpDatetimeFormat' => 'dd.MM.yyyy',
                        'momentDatetimeFormat' => 'DD.MM.YYYY',
                        'clientEvents' => [
                            'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")'),
                        ],
                    ]),
                ],

                [
                    'class' => \backend\grid\ActionColumn::class,
                    'template' => '{view}',
                ],
            ],
        ]); ?>
    </div>
</div>
