<div class="m-error" id="out-page">
  <div class="m-error__content">
    <a class="c-logo" href="/en">
      <img class="c-logo__image"
           src="http://storage.bkw.localhost/source/1/3BBBbkdRZAUWEek_w4Q4E8Uf-S8U8DYd.svg"
           title="<?= Yii::t('frontend', '404 logo title'); ?>"
           alt="<?= Yii::t('frontend', '404 logo alt'); ?>" />
    </a>
    <picture class="c-picture c-picture--auto-height">
      <source srcset="/media/images/404-img.png" media="(max-width: 767px)">
      <source srcset="/media/images/404-img.png" media="(min-width: 768px) and (max-width: 1024px)">
      <source srcset="/media/images/404-img.png" media="(min-width: 1025px) and (max-width: 1599px)">
      <source srcset="/media/images/404-img.png" media="(min-width: 1600px)">
      <img class="c-picture__image"
           title="<?= Yii::t('frontend', '404 image title'); ?>"
           alt="<?= Yii::t('frontend', '404 image alt'); ?>"/>
    </picture>
    <p class="a-text-paragraph a-color-light">
        <?= Yii::t('frontend', 'К сожалению, страница которую Вы искали не существует.'); ?>
      </p>
    <a class="c-link" href="/en">
      <span class="c-link__label">
        <?= Yii::t('frontend', 'На главную'); ?>
      </span>
      <i class="a-icon-arrow-right" role="presentation"></i>
    </a>
  </div>
</div>
