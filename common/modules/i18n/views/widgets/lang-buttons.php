<?php
/**
 * @var $model \yii\base\Model
 * @var $showDeleteButton bool
 * @var $langList \common\modules\i18n\models\Lang []
 */
?>

<div class="row i18n-buttons">
    <div class="col-sm-12 col-md-6">
        <?php if($showDeleteButton == true): ?>
            <?php if($model->hasTranslate($model->language) == true && $model->getLanguage() != \Yii::$app->getModule('i18n')->getDefaultLanguage()): ?>
                <div class="text-left">
                    <?= \yii\helpers\Html::a('<i class="fa fa-trash-o"></i>&nbsp;' . Yii::t('backend', 'Cleare Translation'), ['delete-translate', 'id' => $model->id, 'lang_id' => $model->getLanguage()], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('backend', 'Are you sure you want to clear the translation?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="text-right">
            <div class="btn-group i18n-lang-buttons">
                <?php foreach($langList as $langId => $langName) {
                    $active = $langId == $model->language ? ' active' : '';
                    $color = $model->hasTranslate($langId) ? 'info' : 'default';
                    $url = \yii\helpers\Url::current(['lang_id' => $langId]);

                    echo \yii\helpers\Html::a($langName, $url, [
                        'class' => 'btn btn-' . $color . $active,
                        'title' => "Update $langId version",
                        'data-pjax' => 1,
                    ]);
                } ?>
            </div>
        </div>
    </div>
</div>
<br>
