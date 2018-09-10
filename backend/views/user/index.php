<?php

use common\grid\EnumColumn;
use common\models\User;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="box-body text-right">
    <?= Html::a(
        '<i class="fa fa-plus"></i> ' . Yii::t('backend', 'New entity'),
        ['create'],
        ['class' => 'btn btn-primary btn-sm']
    ) ?>
</div>

<div class="box">
    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
            'id',
            'username',
            'email:email',
            [
                'class' => EnumColumn::class,
                'attribute' => 'status',
                'enum' => User::statuses(),
                'filter' => User::statuses()
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => DateTimeWidget::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'phpDatetimeFormat' => 'dd.MM.yyyy',
                    'momentDatetimeFormat' => 'DD.MM.YYYY',
                    'clientEvents' => [
                        'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
                    ],
                ])
            ],
            [
                'attribute' => 'logged_at',
                'format' => 'datetime',
                'filter' => DateTimeWidget::widget([
                    'model' => $searchModel,
                    'attribute' => 'logged_at',
                    'phpDatetimeFormat' => 'dd.MM.yyyy',
                    'momentDatetimeFormat' => 'DD.MM.YYYY',
                    'clientEvents' => [
                        'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
                    ],
                ])
            ],
            [
                'class' => \backend\grid\ActionColumn::class,
                'template' => '{view} {update} {delete}',
                'visibleButtons' => [
                    'login' => Yii::$app->user->can('administrator')
                ]
            ],
        ],
    ]); ?>
    </div>
</div>
