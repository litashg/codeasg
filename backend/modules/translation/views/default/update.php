<?php

/**
 * @var $this      yii\web\View
 * @var $model     \common\base\MultiModel
 * @var $languages array
 */

$message = \yii\helpers\StringHelper::truncate($model->getModel('source')->message, 35, '...', null, true);

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
        'modelClass' => 'I18n Source Message',
    ]) . ' ' . $message;

$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'I18n Source Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $message, 'url' => ['update', 'id' => $model->getModel('source')->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');

?>

<?= $this->render('_form', [
    'model' => $model,
    'languages' => $languages,
]); ?>


