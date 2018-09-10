<?php

use \yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * @var $this yii\web\View
 * @var $model \common\modules\pages\models\Page
 * @var $modelsBullets \common\modules\pages\models\Bullet []
 * @var $videoModel \common\modules\videoBlock\models\Video
 */

$title = \yii\helpers\StringHelper::truncate($model->getTitle(), 35, '...', null, true);

$this->title = Yii::t('backend', 'Editing') . ': ' . $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Pages'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $title;

$activeTab = Yii::$app->getRequest()->getQueryParam('tab', 'main');

?>

<?= \common\modules\i18n\widgets\LangButtonsWidget::widget(['model' => $model]); ?>

<div class="page-read">
    <div class="page-form">
        <div class="box">
            <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
            <div class="box-body">
                <ul class="nav nav-tabs">
                    <li class="<?= ($activeTab == 'main') ? 'active' : ''; ?>">
                        <a href="#main" data-toggle="tab" aria-expanded="true">
                            <?= \Yii::t('backend', 'Main Tab'); ?>
                        </a>
                    </li>
                    <li class="<?= ($activeTab == 'video') ? 'active' : ''; ?>">
                        <a href="#video" data-toggle="tab" aria-expanded="false">
                            <?= \Yii::t('backend', 'Video'); ?>
                        </a>
                    </li>
                    <?= $this->render('../_seo_page_li.php', ['activeTab' => $activeTab]); ?>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane <?= ($activeTab == 'main') ? 'active' : ''; ?>" id="main">
                        <div class="box-body">
                            <?= $form->field($model, 'title')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'readonly' => true]); ?>

                            <?= $form->field($model, 'body')
                                ->textarea(['maxlength' => true, 'required' => true]); ?>

                            <hr />

                            <?php DynamicFormWidget::begin([
                                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                                'widgetBody' => '.container-items', // required: css class selector
                                'widgetItem' => '.item', // required: css class
                                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                                'min' => 0, // 0 or 1 (default 1)
                                'insertButton' => '.add-item', // css class
                                'deleteButton' => '.remove-item', // css class
                                'model' => $modelsBullets[0],
                                'formId' => 'dynamic-form',
                                'formFields' => [
                                    'text',
                                ],
                            ]); ?>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">
                                        <?= Yii::t('backend', 'Bullets'); ?>
                                    </h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="add-item btn btn-success btn-sm">
                                            <i class="fa fa-plus"></i>
                                            <?= Yii::t('backend', 'Add bullet item'); ?>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body container-items"><!-- widgetContainer -->
                                    <?php foreach ($modelsBullets as $index => $modelBullet): ?>
                                        <div class="item box box-default">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">&nbsp;</h3>
                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn add-item btn-success btn-xs">
                                                        <i class="fa fa-plus"></i>
                                                        <?= Yii::t('backend', 'Add bullet item'); ?>
                                                    </button>
                                                    <button type="button" class="btn remove-item btn-danger btn-xs">
                                                        <i class="fa fa-trash"></i>
                                                        <?= Yii::t('backend', 'Remove'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                                <?php
                                                if (!$modelBullet->isNewRecord) {
                                                    echo Html::activeHiddenInput($modelBullet, "[{$index}]id");
                                                }
                                                ?>
                                                <?= $form->field($modelBullet, "[{$index}]text")->textarea(['maxlength' => true]); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php DynamicFormWidget::end(); ?>
                        </div>
                    </div>

                    <div class="tab-pane <?= ($activeTab == 'video') ? 'active' : ''; ?>" id="video">
                        <?= $this->render('_video_form.php', [
                            'model' => $videoModel,
                        ]); ?>
                    </div>

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