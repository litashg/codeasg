<?php

/**
 * @var $this yii\web\View
 * @var $model \common\modules\news\models\News
 */

$this->title = Yii::t('backend', 'Creation')  . " <strong>({$model->getLanguage()})</strong>";
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'News'), 'url' => ['list']];
$this->params['breadcrumbs'][] = strip_tags($this->title);
?>

<div class="news-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
