<?php
use yii\helpers\Html;
?>
<div class="tab-pane <?= ($activeTab == 'seo') ? 'active' : ''; ?>" id="seo">
    <div class="seo-page-form">
        <div class="box-body">
            <?= $form->field($modelSeo, 'title')->textInput(['maxlength' => true]); ?>
            <?= $form->field($modelSeo, 'description')->textarea(['maxlength' => true]); ?>
            <?= $form->field($modelSeo, 'keywords')->textarea(['maxlength' => true]); ?>
            <div class="panel panel-default">
                <div class="panel-heading"><?= \Yii::t('backend', 'Max. allowed file size'); ?></div>
                <div class="panel-body">
                    <?php if ($modelSeo->verification_tags->isEmpty() === true): ?>
                        <div class="verification_elements " data-el="0">
                            <div class="col-lg-5">
                                <div class="form-group field-page-verification_tags">
                                    <label class="control-label" for="page-verification_tags">Name</label>
                                    <input type="text" id="page-verification_tags"  class="form-control" name="<?= Html::getInputName($modelSeo, 'verification_tags'); ?>[0][name]">
                                    <p class="help-block help-block-error"></p>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group field-page-verification_tags">
                                    <label class="control-label" for="page-verification_tags">Content</label>
                                    <input type="text" id="page-verification_tags" class="form-control" name="<?= Html::getInputName($modelSeo, 'verification_tags'); ?>[0][content]">

                                    <p class="help-block help-block-error"></p>
                                </div>                </div>
                            <div class="col-lg-1 btn btn-danger remove_item">Remove</div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($modelSeo->verification_tags->toArray() as $index => $tag): ?>
                            <div class="verification_elements" data-el="<?= $index?>">
                                <div class="col-lg-5">
                                    <?= $form->field($modelSeo, '[verification_tags]['.$index.']name')->textInput(['maxlength' => true, 'value' => $tag['name']])->label('Name'); ?>
                                </div>
                                <div class="col-lg-5">
                                    <?= $form->field($modelSeo, '[verification_tags]['.$index.']content')->textInput(['maxlength' => true, 'value' => $tag['content']])->label('Content'); ?>
                                </div>
                                <div class="col-lg-1 btn btn-danger remove_item">Remove</div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="btn btn-success" id="seo_page_verification_add">Add more</div>

            <?= $form->field($modelSeo, 'og_type')->dropDownList(\common\modules\seo\models\Page::getOGTypeList()); ?>
            <?= $form->field($modelSeo, 'og_image')->widget(
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

            <?= $form->field($modelSeo, 'twitter_image')->widget(
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
            <?= $form->field($modelSeo, 'index')->dropDownList(\common\modules\seo\models\Page::getIndexList(), ['prompt' => ' ']); ?>
            <?= $form->field($modelSeo, 'follow')->dropDownList(\common\modules\seo\models\Page::getFollowList(), ['prompt' => ' ']); ?>
        </div>
    </div>
</div>
