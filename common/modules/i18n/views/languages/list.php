<?php

use yii\helpers\Html;
use common\modules\i18n\models\Lang;

/**
 * @var $this yii\web\View
 * @var $searchModel common\modules\i18n\models\search\LangSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $filterModel
 */

$this->title = Yii::t('backend', 'Languages List');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-body text-right">
    <?= Html::a(
        '<i class="fa fa-plus"></i> ' . Yii::t('backend', 'New entity'),
        ['create'],
        ['class' => 'btn btn-primary btn-sm']
    ); ?>
</div>

<div class="box">
    <div class="box-body">
        <?= \sjaakp\sortable\SortableGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $filterModel,
            'orderUrl' => ['languages/order'],
            'options' => [
                'class' => 'grid-view table-responsive'
            ],
            'columns' => [
                'code',
                'locale',
                'name',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->getStatusName();
                    },
                    'filter' => Lang::getStatusList()
                ],
                [
                    'class' => \backend\grid\ActionColumn::class,
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
</div>
