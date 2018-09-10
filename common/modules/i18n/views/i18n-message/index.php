<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\i18n\models\search\I18nMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'I18n Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-message-index">

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['width' => '8%'],
            ],
            [
                'attribute'=>'language',
                'filter'=> $languages
            ],
            [
                'attribute'=>'category',
                'filter'=> $categories
            ],
            'sourceMessage',
            'translation:ntext',
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}'],
        ],
    ]); ?>

</div>