<?php

use backend\modules\translation\models\Source;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/**
 * @var $this               yii\web\View
 * @var $searchModel        backend\modules\translation\models\search\SourceSearch
 * @var $dataProvider       yii\data\ActiveDataProvider
 * @var $model              \common\base\MultiModel
 * @var $languages          array
 */

$this->title = Yii::t('backend', 'Translation');
$this->params['breadcrumbs'][] = $this->title;

$translationColumns = [];
foreach ($languages as $language => $name) {
    $translationColumns[] = [
        'attribute' => $language,
        'header' => $name,
        'value' => $language . '.translation',
    ];
}
?>

<div class="box">
    <div class="box-body">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'options' => [
                'class' => 'grid-view table-responsive',
            ],
            'columns' => ArrayHelper::merge([
                [
                    'attribute' => 'id',
                    'options' => ['style' => 'width: 5%'],
                ],
                [
                    'attribute' => 'category',
                    'options' => ['style' => 'width: 10%'],
                    'filter' => ArrayHelper::map(Source::find()->select('category')->distinct()->all(), 'category', 'category'),
                ],
                'message:ntext',
                [
                    'class' => \backend\grid\ActionColumn::class,
                    'template' => '{update}',
                ],
            ], $translationColumns),
        ]); ?>

    </div>
</div>
