<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\rbac\models\RbacAuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rbac-auth-item-child-form">
    <div class="box">
    <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <?php echo $form->field($model, 'parent')->textInput(['maxlength' => true]) ?>

            <?php echo $form->field($model, 'child')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="box-footer">
            <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end() ?>
    </div>
</div>
