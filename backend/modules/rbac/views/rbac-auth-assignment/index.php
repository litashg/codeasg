<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Rbac Auth Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rbac-auth-assignment-index">

    <p>
        <?php echo Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Rbac Auth Assignment',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'item_name',
                    'user_id',
                    'created_at:datetime',

                    ['class' => \backend\grid\ActionColumn::class],
                ],
            ]); ?>

        </div>
    </div>
</div>
