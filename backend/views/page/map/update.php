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

<?= \common\modules\i18n\widgets\LangButtonsWidget::widget(['model' => $model]); ?>

<div class="page-read">
    <div class="page-form">
        <div class="box">
            <?php $form = ActiveForm::begin(['id' => 'seo_page']); ?>
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
                            <?= $form->field($model, 'title')
                                ->textInput(['maxlength' => true, 'required' => true]); ?>

                            <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'readonly' => true]); ?>

                        </div>
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
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>