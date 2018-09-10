<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $form yii\bootstrap\ActiveForm
 */

$activeTab = Yii::$app->getRequest()->getQueryParam('tab', 'main');
?>

<div class="news-form">
    <div class="box">
        <?php $form = ActiveForm::begin(); ?>
        <div class="box-body">
            <ul class="nav nav-tabs">
                <li class="<?= ($activeTab == 'main') ? 'active' : ''; ?>">
                    <a href="#main" data-toggle="tab" aria-expanded="true">
                        <?= \Yii::t('backend', 'Main Tab'); ?>
                    </a>
                </li>
                <li class="<?= ($activeTab == 'quote') ? 'active' : ''; ?>">
                    <a href="#quote" data-toggle="tab" aria-expanded="true">
                        <?= \Yii::t('backend', 'Quote'); ?>
                    </a>
                </li>
                <li class="<?= ($activeTab == 'seo') ? 'active' : ''; ?>">
                    <a href="#seo" data-toggle="tab" aria-expanded="false">
                        <?= \Yii::t('backend', 'SEO'); ?>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane <?= ($activeTab == 'main') ? 'active' : ''; ?>" id="main">
                    <div class="box-body">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'required' => true]); ?>

                        <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]); ?>

                        <?= $form->field($model, 'slug')->textInput(['maxlength' => true])
                            ->hint(Yii::t('backend', 'Если вы оставите это поле пустым, ЧПУ будет сгенерирован автоматически'));
                        ?>

                        <?= $form->field($model, 'body')->widget(
                            \yii\imperavi\Widget::class,
                            [
                                'plugins' => ['fullscreen', 'video', 'filemanager'],
                                'options' => [
                                    'minHeight' => 400,
                                    'maxHeight' => 400,
                                    'buttonSource' => true,
                                    'toolbarFixed' => false,
                                    'replaceDivs' => false,
                                    'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
                                    'fileUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
                                    'buttons' => [
                                        'html','formatting','bold','italic','deleted','unorderedlist',
                                        'orderedlist','image','file','link','alignment','horizontalrule'
                                    ],
                                    'formatting' => ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4']
                                ]
                            ]
                        ); ?>

                        <?= $form->field($model, 'preview_image')->widget(
                            \common\modules\cropper\widgets\Upload::class, [
                            'url' => ['/file/storage/upload'],
                            'maxFileSize' => 10000000, // 10 MiB
                            'clientOptions' => [
                                'autoUpload' => false,
                                'crop' => true,
                                'cropper' => [
                                    'aspectRatio' => 477/210,
                                ],
                            ],
                            'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpeg|jpg|png)$/i'),
                        ]); ?>
                        <ul class="help-block">
                            <li>
                                <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                            </li>
                            <li>
                                <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.jpeg, *.jpg, *.png</strong>
                            </li>
                        </ul>

                        <?= $form->field($model, 'image')->widget(
                            \common\modules\cropper\widgets\Upload::class, [
                            'url' => ['/file/storage/upload'],
                            'maxFileSize' => 10000000, // 10 MiB
                            'clientOptions' => [
                                'autoUpload' => false,
                                'crop' => true,
                                'cropper' => [
                                    'aspectRatio' => 1308/575,
                                ],
                            ],
                            'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpeg|jpg|png)$/i'),
                        ]); ?>
                        <ul class="help-block">
                            <li>
                                <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                            </li>
                            <li>
                                <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.jpeg, *.jpg, *.png</strong>
                            </li>
                        </ul>

                        <?= $form->field($model, 'mobile_image')->widget(
                            \common\modules\cropper\widgets\Upload::class, [
                            'url' => ['/file/storage/upload'],
                            'maxFileSize' => 10000000, // 10 MiB
                            'clientOptions' => [
                                'autoUpload' => false,
                                'crop' => true,
                                'cropper' => [
                                    'aspectRatio' => 4/3,
                                ],
                            ],
                            'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpeg|jpg|png)$/i'),
                        ]); ?>
                        <ul class="help-block">
                            <li>
                                <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                            </li>
                            <li>
                                <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.jpeg, *.jpg, *.png</strong>
                            </li>
                        </ul>

                        <?= $form->field($model, 'published_at')->widget(
                            \trntv\yii\datetime\DateTimeWidget::class,
                            [
                                'phpDatetimeFormat' => 'yyyy-MM-dd'
                            ]
                        ); ?>

                        <?= $form->field($model, 'status')->dropDownList(\common\modules\pages\models\Page::getStatuses()); ?>

                    </div>
                </div>

                <div class="tab-pane <?= ($activeTab == 'quote') ? 'active' : ''; ?>" id="quote">
                    <div class="box-body">
                        <?= $form->field($model, 'quote_photo')->widget(
                            \common\modules\cropper\widgets\Upload::class, [
                            'url' => ['/file/storage/upload'],
                            'maxFileSize' => 10000000, // 10 MiB
                            'clientOptions' => [
                                'autoUpload' => false,
                                'crop' => true,
                                'cropper' => [
                                    'aspectRatio' => 1
                                ],
                            ],
                            'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(jpeg|jpg|png)$/i'),
                        ]); ?>
                        <ul class="help-block">
                            <li>
                                <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                            </li>
                            <li>
                                <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.jpeg, *.jpg, *.png</strong>
                            </li>
                        </ul>

                        <?= $form->field($model, 'quote')->textarea(); ?>

                    </div>
                </div>

                <div class="tab-pane <?= ($activeTab == 'seo') ? 'active' : ''; ?>" id="seo">
                    <?= $this->render('@common/modules/seo/views/seo/_form', [
                        'form' => $form,
                        'model' => $model,
                    ]); ?>
                </div>
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
                    \yii\helpers\Url::toRoute(['list']),
                    ['class' => 'btn btn-default']
                ); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>