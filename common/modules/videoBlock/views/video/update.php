<?php

/**
 * @var $this yii\web\View
 * @var $model \common\modules\videoBlock\models\Video
 */

$this->title = Yii::t('backend', 'Editing') . ': ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Video block'), 'url' => ['list']];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Save');
?>

<?= \common\modules\i18n\widgets\LangButtonsWidget::widget(['model' => $model]); ?>

<div class="video-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
