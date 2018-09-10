<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model \common\modules\videoBlock\models\Video
 * @var $form yii\bootstrap\ActiveForm
 */

?>

<div class="video-form">
    <div class="box">
        <?php $form = ActiveForm::begin(); ?>
            <div class="box-body">

                <?= $form->field($model, 'image')->widget(
                    \common\modules\cropper\widgets\Upload::class, [
                    'url' => ['/file/storage/upload'],
                    'maxFileSize' => 10000000, // 10 MiB
                    'clientOptions' => [
                        'autoUpload' => false,
                        'crop' => true,
                        'cropper' => [
                            'aspectRatio' => 16/9
                        ],
                    ],
                    'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpeg|png|jpg)$/i'),
                ]); ?>
                <ul class="help-block">
                    <li>
                        <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                    </li>
                    <li>
                        <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.jpeg, *.jpg, *.png</strong>
                    </li>
                </ul>

                <?= $form->field($model, 'image_title')->textInput(['maxlength' => true]); ?>
                <?= $form->field($model, 'image_alt')->textInput(['maxlength' => true]); ?>

                <?= $form->field($model, 'youtube_video_link')->textInput(['maxlength' => true, 'required' => true]); ?>

                <?= $form->field($model, 'status')->dropDownList(\common\modules\videoBlock\models\Video::getStatuses()); ?>
            </div>

            <div class="box-footer">
                <?= Html::submitButton(
                    '<i class="fa fa-save"></i> ' . Yii::t('backend', 'Save'),
                    ['class' => 'btn btn-primary']
                ); ?>
                <?= Html::a(
                    Yii::t('backend', 'Cancel'),
                    \yii\helpers\Url::toRoute(['list']),
                    ['class' => 'btn btn-default']
                ); ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>