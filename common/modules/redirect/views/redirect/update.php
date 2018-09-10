<?php
/**
 * @var $this yii\web\View
 * @var $model \common\modules\i18n\models\Lang
 */

$this->title = Yii::t('backend', 'Editing');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Redirects List'), 'url' => ['list']];
?>

<div class="languages-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>
</div>
