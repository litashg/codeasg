<?php

/**
 * @var $this yii\web\View
 * @var $model \common\modules\i18n\models\Lang
 */

$this->title = Yii::t('backend', 'Creation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Redirect List'), 'url' => ['list']];
?>

<div class="languages-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
