<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Rbac Auth Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-rule-index">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create Rbac Auth Rule'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    'data',
                    'created_at:datetime',
                    'updated_at:datetime',

                    ['class' => \backend\grid\ActionColumn::class],
                ],
            ]); ?>
        </div>
    </div>
</div>
