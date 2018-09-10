<?php


/**
 * @var $model \common\modules\keyStorage\components\FormModel
 */

$this->title = Yii::t('backend', 'Site settings');

?>

<div class="box">
    <div class="box-body">
        <?= \common\modules\keyStorage\components\FormWidget::widget([
            'model' => $model,
            'formClass' => '\yii\bootstrap\ActiveForm',
            'submitText' => Yii::t('backend', 'Save'),
            'submitOptions' => ['class' => 'btn btn-primary'],
        ]) ?>
    </div>
</div>