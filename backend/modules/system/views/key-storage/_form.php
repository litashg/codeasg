<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \common\modules\keyStorage\models\KeyStorageItem */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="key-storage-item-form">
    <div class="box">
    <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <?php echo $form->field($model, 'key')->textInput(['readonly' => true]) ?>

            <?php echo $form->field($model, 'value')->textInput() ?>

            <?php echo $form->field($model, 'comment')->textarea() ?>
        </div>

        <div class="box-footer">
            <?= Html::submitButton(
                '<i class="fa fa-save"></i> ' . Yii::t('backend', 'Save'),
                ['class' => 'btn btn-primary']
            ); ?>
        </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
