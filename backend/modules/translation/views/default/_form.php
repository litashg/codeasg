<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var $this      yii\web\View
 * @var $model     \common\base\MultiModel
 * @var $languages array
 */

?>

<div class="box">
    <?php $form = ActiveForm::begin(); ?>

        <div class="box-body">
            <?php echo $form->field($model->getModel('source'), 'category')->textInput(['maxlength' => 32, 'readonly' => true]) ?>

            <?php echo $form->field($model->getModel('source'), 'message')->textarea(['readonly' => true]); ?>

            <?php if (!$model->getModel('source')->isNewRecord): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo Yii::t('backend', 'Translations') ?></h3>
                    </div>
                    <div class="panel-body">
                        <?php foreach ($languages as $language => $name) {
                            echo $form->field($model->getModel($language), 'translation')->textarea([
                                'id' => $language . '-translation',
                                'name' => $language . '[translation]',
                            ])->label($name);
                        } ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="box-footer">
            <?= Html::submitButton(
                '<i class="fa fa-save"></i> ' . Yii::t('backend', 'Save'),
                ['class' => 'btn btn-primary']
            ); ?>

            <?= Html::a(
                Yii::t('backend', 'Cancel'),
                \yii\helpers\Url::toRoute(\yii\helpers\Url::previous('translation-filter') ?: ['index']),
                ['class' => 'btn btn-default']
            ); ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
