<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\UserSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="box box-info">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-search"></i> <?= Yii::t('backend', 'Filter'); ?></h3>
        </div>
        <div class="box-body">
            <?php echo $form->field($model, 'id') ?>

            <?php echo $form->field($model, 'username') ?>

            <?php echo $form->field($model, 'auth_key') ?>

            <?php echo $form->field($model, 'email') ?>

            <?php echo $form->field($model, 'status') ?>

            <?php echo $form->field($model, 'created_at') ?>

            <?php echo $form->field($model, 'updated_at') ?>
        </div>
        <div class="box-footer text-right">
            <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>
    <?php ActiveForm::end() ?>
</div>
