<?php

/**
 * @var $this yii\web\View
 * @var $searchModel \common\modules\seo\models\search\PageSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('backend', 'Seo Pages');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="seo-index">
    <div class="box">
        <div class="box-body">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $filterModel,
                'options' => [
                    'class' => 'grid-view table-responsive'
                ],
                'columns' => [
                    [
                        'attribute' => 'id',
                        'options' => ['width' => '5%'],
                    ],
                    'url',
                    'title',
                    [
                        'class' => \backend\grid\ActionColumn::class,
                        'template' => '{update}',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>