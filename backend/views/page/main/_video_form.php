<?php

use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model \common\modules\videoBlock\models\Video
 * @var $form yii\bootstrap\ActiveForm
 */

?>

<div class="video-form">
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>
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

            <?= $form->field($model, 'video')->widget(
                \common\modules\cropper\widgets\Upload::class, [
                'url' => ['/file/storage/upload'],
                'maxFileSize' => 50000000, // 50 MiB
                'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(mp4|mov)$/i'),
            ]); ?>
            <ul class="help-block">
                <li>
                    <?= \Yii::t('backend', 'Max. allowed file size'); ?> <strong>50 MB</strong>
                </li>
                <li>
                    <?= \Yii::t('backend', 'Allowed file types'); ?> <strong>*.mp4, *.mov</strong>
                </li>
            </ul>

        <?php ActiveForm::end(); ?>
    </div>
</div>