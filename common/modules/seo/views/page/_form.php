<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\modules\seo\models\Page;

/**
 * @var $this yii\web\View
 * @var $model \common\modules\seo\models\Page
 * @var $form yii\bootstrap\ActiveForm
 */
?>
<div class="seo-page-form">
    <div class="box ">
        <?php $form = ActiveForm::begin(['id' => 'seo_page']); ?>
        <div class="box-body">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]); ?>
            <?= $form->field($model, 'keywords')->textarea(['maxlength' => true]); ?>

            <div class="panel panel-default">
                <div class="panel-heading">Verification Tag</div>
                <div class="panel-body">
            <?php if($model->verification_tags->isEmpty() === true): ?>
                <div class="verification_elements " data-el="0">
                    <div class="col-lg-5">
                        <div class="form-group field-page-verification_tags">
                            <label class="control-label" for="page-verification_tags">Name</label>
                            <input type="text" id="page-verification_tags"  class="form-control" name="<?= Html::getInputName($model, 'verification_tags'); ?>[0][name]">
                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group field-page-verification_tags">
                            <label class="control-label" for="page-verification_tags">Content</label>
                            <input type="text" id="page-verification_tags" class="form-control" name="<?= Html::getInputName($model, 'verification_tags'); ?>[0][content]">

                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>
                    <div class="col-lg-1 btn btn-danger remove_item">Remove</div>
                </div>
            <?php else: ?>
                <?php foreach ($model->verification_tags->toArray() as $index => $tag): ?>
                        <div class="verification_elements" data-el="<?= $index?>">
                            <div class="col-lg-5">
                                <?= $form->field($model, '[verification_tags]['.$index.']name')->textInput(['maxlength' => true, 'value' => $tag['name']])->label('Name'); ?>
                            </div>
                            <div class="col-lg-5">
                                <?= $form->field($model, '[verification_tags]['.$index.']content')->textInput(['maxlength' => true, 'value' => $tag['content']])->label('Content'); ?>
                            </div>
                            <div class="col-lg-1 btn btn-danger remove_item">Remove</div>
                        </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
            </div>

            <div class="clearfix"></div>
            <div class="btn btn-success" id="seo_verification_add">Add more</div>

            <?= $form->field($model, 'og_type')->dropDownList(Page::getOGTypeList()); ?>
            <?= $form->field($model, 'og_image')->widget(
                \trntv\filekit\widget\Upload::class, [
                'url' => ['/file/storage/upload'],
                'maxFileSize' => 10000000, // 10 MiB
                'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpe?g|png)$/i'),
            ]); ?>
            <ul class="help-block">
                <li>
                    <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                </li>
                <li>
                    <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.jpeg, *.jpg, *.png</strong>
                </li>
            </ul>

            <?= $form->field($model, 'twitter_image')->widget(
                \trntv\filekit\widget\Upload::class, [
                'url' => ['/file/storage/upload'],
                'maxFileSize' => 10000000, // 10 MiB
                'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpe?g|png)$/i'),
            ]); ?>
            <ul class="help-block">
                <li>
                    <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                </li>
                <li>
                    <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.jpeg, *.jpg, *.png</strong>
                </li>
            </ul>
            <?= $form->field($model, 'index')->dropDownList(Page::getIndexList(), ['prompt' => ' ']); ?>
            <?= $form->field($model, 'follow')->dropDownList(Page::getFollowList(), ['prompt' => ' ']); ?>
        </div>

        <div class="box-footer">
            <?= Html::submitButton(
                '<i class="fa fa-save save"></i> ' . Yii::t('backend', 'Save'),
                ['class' => 'btn btn-primary']
            ); ?>
            <?= Html::submitButton(
                Yii::t('backend', 'Save & stay'),
                [
                    'class' => 'btn btn-success save',
                    'name' => 'save_and_stay'
                ]
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