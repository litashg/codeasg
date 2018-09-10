<?php

use \yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var $this yii\web\View
 * @var $model \common\modules\pages\models\Page
 */

$title = \yii\helpers\StringHelper::truncate($modelPage->getTitle(), 35, '...', null, true);
$this->title = Yii::t('backend', 'Editing') . ': ' . $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $title;
$activeTab = Yii::$app->getRequest()->getQueryParam('tab', 'main');

?>

<?= \common\modules\i18n\widgets\LangButtonsWidget::widget(['model' => $modelPage]); ?>

<div class="page-read">
    <div class="page-form">
        <div class="box">
            <?php $form = ActiveForm::begin(['enableClientValidation' => false, 'id' => 'seo_page']);?>
            <div class="box-body">
                <ul class="nav nav-tabs">
                    <li class="<?= ($activeTab == 'main') ? 'active' : ''; ?>">
                        <a href="#main" data-toggle="tab" aria-expanded="true">
                            <?= \Yii::t('backend', 'Main Tab'); ?>
                        </a>
                    </li>
                    <?= $this->render('../_seo_page_li.php', ['activeTab' => $activeTab]); ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane <?= ($activeTab == 'main') ? 'active' : ''; ?>" id="main">
                        <div class="box-body">
                            <?= $form->field($modelPage, 'title')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($modelPage, 'url')
                                ->textInput(['maxlength' => true, 'readonly' => true]); ?>

                            <?= $form->field($modelContact, 'company_name')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($modelContact, 'address_line_1')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($modelContact, 'address_line_2')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($modelContact, 'address_line_3')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <?php if($modelContact->phone->isEmpty() === true): ?>
                                        <div class="phone_element" data-el="0">
                                            <div class="col-lg-11">
                                                <?= $form->field($modelContact, 'phone[]')
                                                    ->input('text', ['maxlength' => true]); ?>
                                            </div>
                                            <div class="col-lg-1 btn btn-danger phone_remove_item">
                                                <?= Yii::t('backend', 'Remove'); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($modelContact->phone->toArray() as $index => $el): ?>
                                            <div class="phone_element" data-el="<?= $index?>">
                                                <div class="col-lg-11">
                                                    <?= $form->field($modelContact, 'phone['.$index.']')
                                                        ->input('text', ['maxlength' => true]); ?>
                                                </div>
                                                <div class="col-lg-1 btn btn-danger phone_remove_item">
                                                    <?= Yii::t('backend', 'Remove'); ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="btn btn-success add_button" id="contact_phone_add">
                                <?= Yii::t('backend', 'Add more'); ?>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <?php if($modelContact->email->isEmpty() == true): ?>
                                        <div class="email_element" data-el="0">
                                            <div class="col-lg-11">
                                                <?= $form->field($modelContact, 'email[]')
                                                    ->input('email', ['maxlength' => true])->label('Email'); ?>
                                            </div>
                                            <div class="col-lg-1 btn btn-danger remove_item">
                                                <?= Yii::t('backend', 'Remove'); ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <?php foreach ($modelContact->email->toArray() as $index => $el): ?>
                                            <div class="email_element" data-el="<?= $index?>">
                                                <div class="col-lg-11">
                                                    <?= $form->field($modelContact, 'email['.$index.']')
                                                        ->input('email', ['maxlength' => true])->label('Email'); ?>
                                                </div>
                                                <div class="col-lg-1 btn btn-danger remove_item">
                                                    <?= Yii::t('backend', 'Remove'); ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="btn btn-success add_button" id="contact_email_add">
                                <?= Yii::t('backend', 'Add more'); ?>
                            </div>
                            <?= $form->field($modelContact, 'latitude')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($modelContact, 'longitude')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>
                        </div>
                    </div>
                    <div class="tab-pane <?= ($activeTab == 'video') ? 'active' : ''; ?>" id="video"></div>
                    <?= $this->render('../_seo_page_form.php', ['activeTab' => $activeTab, 'form' => $form, 'modelSeo' => $modelSeo]); ?>
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
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>