<?php

use yii\grid\GridView;

/**
 * @var $this         yii\web\View
 * @var $searchModel  \common\modules\keyStorage\models\search\KeyStorageItemSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        \common\modules\keyStorage\models\KeyStorageItem
 */

$this->title = Yii::t('backend', 'Key Storage Items');

$this->params['breadcrumbs'][] = $this->title;

?>
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

                'key',
                'value',

                [
                    'class' => \backend\grid\ActionColumn::class,
                    'template' => '{update}',
                ],
            ],
        ]); ?>
    </div>
</div>
