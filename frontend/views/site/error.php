<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;

?>


<div class="m-error">
    <svg id="m-error__svg"></svg>
    <div class="m-error__content">
        <div class="m-error__title a-color-light">
            <?= Yii::t('frontend', '404'); ?>
        </div>
        <p class="a-text-paragraph a-color-light">
            <?= Yii::t('frontend', 'Page not found'); ?>
        </p>
        <a href="<?= \yii\helpers\Url::toRoute(['site/index']); ?>" class="c-link c-link--light">
            <span class="c-link__label">
                <?= Yii::t('frontend', 'To main page'); ?>
            </span>
            <i class="a-icon-arrow-right"></i>
        </a>
    </div>
</div>
