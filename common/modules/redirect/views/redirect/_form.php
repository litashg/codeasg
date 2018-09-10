<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\modules\i18n\models\I18nSourceMessage */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="">
    <div class="box">
        <?php $form = ActiveForm::begin() ?>
        <div class="box-body">
            <?php echo $form->field($model, 'from_url')->textInput() ?>
            <?php echo $form->field($model, 'to_url')->textInput() ?>
            <?php echo $form->field($model, 'code')->dropDownList(\common\modules\redirect\models\Redirect::CODES_ARR) ?>
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
                Url::toRoute(Url::previous(Yii::$app->controller->id . "-filter") ?:['list']),
                ['class' => 'btn btn-default']
            ); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
