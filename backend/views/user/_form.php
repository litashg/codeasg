<?php

use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */
?>

<div class="box">
    <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <?php echo $form->field($model, 'username') ?>
            <?php echo $form->field($model, 'email') ?>
            <?php echo $form->field($model, 'password')->passwordInput() ?>
            <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
            <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>
        </div>
        <div class="box-footer">
            <?php echo Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-primary', 'name' => 'signup-button']); ?>
        </div>
    <?php ActiveForm::end() ?>
</div>