<?php
/**
 * @var $this yii\web\View
 * @var $model \common\modules\i18n\models\Lang
 */

$this->title = Yii::t('backend', 'Editing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Languages List'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $model->locale;
?>

<div class="languages-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>
</div>
