<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\modules\i18n\models\Lang;

/* @var $this yii\web\View */
/* @var $model common\modules\i18n\models\I18nSourceMessage */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="">
    <div class="box">
        <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <?php echo $form->field($model, 'code')->textInput() ?>
            <?php echo $form->field($model, 'locale')->textInput() ?>
            <?php echo $form->field($model, 'name')->textInput() ?>
            <?php echo $form->field($model, 'status')->dropDownList(Lang::getStatusList()); ?>
        </div>

        <div class="box-footer">
            <?= Html::submitButton(
                '<i class="fa fa-save"></i> ' . Yii::t('backend', 'Save'),
                ['class' => 'btn btn-primary']
            ); ?>
            <?= Html::submitButton(
                Yii::t('backend', 'Save & stay'),
                [
                    'class' => 'btn btn-success',
                    'name' => 'save_and_stay'
                ]
            ); ?>
            <?= Html::a(
                Yii::t('backend', 'Cancel'),
                yii\helpers\Url::toRoute(\yii\helpers\Url::previous(\Yii::$app->controller->id . "-filter") ?:['list']),
                ['class' => 'btn btn-default']
            ); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
