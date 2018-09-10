<?php

use \yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model \common\modules\pages\models\Page
 */

$title = \yii\helpers\StringHelper::truncate($model->getTitle(), 35, '...', null, true);

$this->title = Yii::t('backend', 'Editing') . ': ' . $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $title;

$activeTab = Yii::$app->getRequest()->getQueryParam('tab', 'main');

?>

<?= \common\modules\i18n\widgets\LangButtonsWidget::widget(['model' => $model, 'showDeleteButton' => true]); ?>

<div class="page-read">

    <div class="page-form">
        <div class="box">

            <?php $form = ActiveForm::begin(); ?>

            <div class="box-body">
                <ul class="nav nav-tabs">
                    <li class="<?= ($activeTab == 'main') ? 'active' : ''; ?>">
                        <a href="#main" data-toggle="tab" aria-expanded="true">
                            <?= \Yii::t('backend', 'Main Tab'); ?>
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
                            <?= $form->field($model, 'title')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'readonly' => true]); ?>

                            <?= $form->field($model, 'body')
                                ->textarea(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($model, 'footnote')
                                ->textInput(['maxlength' => 255]); ?>


                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'footnote_image')->widget(
                                        \trntv\filekit\widget\Upload::class, [
                                        'url' => ['/file/storage/upload'],
                                        'maxFileSize' => 10000000, // 10 MiB
                                        'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(svg|png)$/i'),
                                    ]); ?>
                                    <ul class="help-block">
                                        <li>
                                            <?= \Yii::t('backend', 'Max. allowed file size'); ?>: <strong>10 MB</strong>
                                        </li>
                                        <li>
                                            <?= \Yii::t('backend', 'Allowed file types'); ?>: <strong>*.svg, *.png</strong>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'footnote_image_title')->textInput(['maxlength' => true]); ?>
                                    <?= $form->field($model, 'footnote_image_alt')->textInput(['maxlength' => true]); ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane <?= ($activeTab == 'seo') ? 'active' : ''; ?>" id="seo">

                    </div>
                </div>

                <div class="box-footer">
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ' . Yii::t('backend', 'Save'),
                        ['class' => 'btn btn-primary']
                    ); ?>
                    <?= Html::a(
                        Yii::t('backend', 'Cancel'),
                        yii\helpers\Url::toRoute(\yii\helpers\Url::current()),
                        ['class' => 'btn btn-default']
                    ); ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>