<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */
?>
<?php $this->beginContent('@frontend/views/layouts/_clear.php'); ?>

<div class="m-loader">
  <div class="m-loader__back"></div>
  <div class="m-loader__logo">
    <svg xmlns="http://www.w3.org/2000/svg" width="51" height="64" viewBox="0 0 51 64">
      <g fill="none" fill-rule="evenodd">
        <polygon class="m-loader__line" stroke="#D7B56D" stroke-width="1.5" points=".937 63.066 .937 .934 49.509 .934 49.509 63.066"/>
        <polygon fill="#D7B56D" points="4.27 4.612 4.27 24.638 14.813 35.156 25.372 24.622 35.93 35.156 46.177 24.933 46.177 4.612"/>
        <polygon fill="#D7B56D" points="14.813 39.397 4.27 28.879 4.27 59.388 46.177 59.388 46.177 29.175 35.93 39.397 25.372 28.863"/>
      </g>
    </svg>

  </div>
</div>

<div id="root" class="m-layout">
    <!--<header class="m-header">
      <a href="/">
        <h1>
          <img src="<?php /*echo Yii::getAlias('@storageUrl/source/', false) . Yii::$app->keyStorage->get('frontend.image.logo')*/?>" alt="bkw logo">
        </h1>
      </a>
    </header>-->
    <main class="m-main">
        <?= $content; ?>
    </main>
</div>
<div id="tooltip-root" class="m-tooltips">
</div>
<?php $this->endContent(); ?>
