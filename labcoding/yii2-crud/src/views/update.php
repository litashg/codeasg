<?php

/**
 * @var $this yii\web\View
 * @var $model \common\modules\news\models\News
 */

$title = \yii\helpers\StringHelper::truncate($model->getTitle(), 35, '...', null, true);

$this->title = Yii::t('backend', 'Editing') . ': ' . $title . " <strong>({$model->language})</strong>";
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $title;
?>

<?= \common\modules\i18n\widgets\LangButtonsWidget::widget(['model' => $model, 'showDeleteButton' => true]); ?>

<div class="news-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
