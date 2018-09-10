<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\redirect\models\Redirect;
use backend\grid\ActionColumn;

/**
 * @var $this yii\web\View
 * @var $searchModel common\modules\redirect\models\search\RedirectSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $filterModel
 */

$this->title = Yii::t('backend', 'Redirects List');
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
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $filterModel,
            'columns'      => [
                'id',
                'from_url',
                'to_url',
                'code',
                [
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete}',
                ],
            ],
        ]); ?>
    </div>
</div>
