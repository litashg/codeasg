<?php

/**
 * @var $this yii\web\View
 * @var $model \common\modules\i18n\models\Lang
 */

$this->title = Yii::t('backend', 'Creation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Languages List'), 'url' => ['list']];
$this->params['breadcrumbs'][] = strip_tags($this->title);
?>

<div class="languages-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
