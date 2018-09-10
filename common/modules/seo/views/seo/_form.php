<?php
/**
 * @var $form yii\bootstrap\ActiveForm
 * @var $model \yii\base\Model
 */
?>

<div class="box-body">
    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]); ?>
    <?= $form->field($model, 'meta_description')->textarea(['maxlength' => true]); ?>
    <?= $form->field($model, 'meta_keywords')->textarea(['maxlength' => true]); ?>

    <?= $form->field($model, 'meta_og_image')->widget(
        \common\modules\cropper\widgets\Upload::class, [
        'url' => ['/file/storage/upload'],
        'maxFileSize' => 10000000, // 10 MiB
        'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpe?g|png)$/i'),
    ]); ?>
    <ul class="help-block">
        <li>
            <?= \Yii::t('backend', 'макс. допустимый размер изображения'); ?> <strong>10 MB</strong>
        </li>
    </ul>

    <?= $form->field($model, 'meta_twitter_image')->widget(
        \common\modules\cropper\widgets\Upload::class, [
        'url' => ['/file/storage/upload'],
        'maxFileSize' => 10000000, // 10 MiB
        'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpe?g|png)$/i'),
    ]); ?>
    <ul class="help-block">
        <li>
            <?= \Yii::t('backend', 'макс. допустимый размер изображения'); ?> <strong>10 MB</strong>
        </li>
    </ul>
</div>