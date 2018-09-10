<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthAssignment */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="rbac-auth-assignment-form">
    <div class="box">
        <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <?php echo $form->errorSummary($model); ?>

            <?php echo $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'created_at')->textInput() ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end() ?>

    </div>
</div>
