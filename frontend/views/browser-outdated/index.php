<div class="m-old" id="out-page">
    <div class="m-old__header">
    <a class="c-logo" href="/en">
        <img class="c-logo__image"
        src="http://storage.bkw.localhost/source/1/3BBBbkdRZAUWEek_w4Q4E8Uf-S8U8DYd.svg"
        title="<?= Yii::t('frontend', '404 logo title'); ?>"
        alt="<?= Yii::t('frontend', '404 logo alt'); ?>" />
    </a>
    </div>
    <div class="m-old__content">

    <h2 class="m-old__title a-text-h2 a-color-dark">
        <?= Yii::t('frontend', 'Вы используете устаревший браузер'); ?>
    </h2>
    <p class="m-old__description a-text-paragraph a-color-dark-soft">
        <?= Yii::t('frontend', 'К сожалению, Ваш браузер не может обеспечить стабильную работу с сайтом. Для того что бы просмотреть содержимое вам следует использовать последнюю доступную версию браузера от официального разработчика. Скачать последнюю версию можно ниже:'); ?>
    </p>

    <div class="m-old__list">
    <!-- IF DESKTOP -->
    <?php if (true === Yii::$app->agent->isDesktop()): ?>
        <!-- IF MAC OS X  -->
        <?php if (Yii::$app->agent->is('OS X')): ?>
            <a href="https://www.apple.com/safari/" class="c-browser">
                <img src="/media/browsers/safari.png" alt="" class="c-browser__logo">
                <p class="c-browser__title a-text-lead a-color-dark">
                    <?= Yii::t('frontend', 'Safari'); ?>
                </p>
                <p class="c-browser__link c-external-link">
                    <?= Yii::t('frontend', 'Узнать больше'); ?>
                </p>
            </a>
        <?php endif; ?>
        <!-- IF WIN 10  -->
        <?php if (Yii::$app->agent->is('Windows') && 'Windows NT 10' === Yii::$app->agent->version(Yii::$app->agent->platform())): ?>
            <a href="https://www.microsoft.com/uk-ua/windows/microsoft-edge" class="c-browser">
                <img src="/media/browsers/edge.png" alt="" class="c-browser__logo">
                <p class="c-browser__title a-text-lead a-color-dark">
                    <?= Yii::t('frontend', 'Microsoft Edge'); ?>
                </p>
                <p class="c-browser__link c-external-link">
                    <?= Yii::t('frontend', 'Узнать больше'); ?>
                </p>
            </a>
        <?php endif; ?>
        <!-- COMMON DESKTOP -->
        <a href="https://www.google.com/intl/uk/chrome/" class="c-browser">
            <img src="/media/browsers/chrome.png" alt="" class="c-browser__logo">
            <p class="c-browser__title a-text-lead a-color-dark">
                <?= Yii::t('frontend', 'Google Chrome'); ?>
            </p>
            <p class="c-browser__link c-external-link">
                <?= Yii::t('frontend', 'Скачать'); ?>
            </p>
        </a>
        <a href="https://www.mozilla.org/uk/firefox/new/" class="c-browser">
            <img src="/media/browsers/firefox.png" alt="" class="c-browser__logo">
            <p class="c-browser__title a-text-lead a-color-dark">
                <?= Yii::t('frontend', 'Mozilla Firefox'); ?>
            </p>
            <p class="c-browser__link c-external-link">
                <?= Yii::t('frontend', 'Скачать'); ?>
            </p>
        </a>
        <a href="https://www.opera.com/uk" class="c-browser">
            <img src="/media/browsers/opera.png" alt="" class="c-browser__logo">
            <p class="c-browser__title a-text-lead a-color-dark">
                <?= Yii::t('frontend', 'Opera'); ?>
            </p>
            <p class="c-browser__link c-external-link">
                <?= Yii::t('frontend', 'Скачать'); ?>
            </p>
        </a>
    <?php endif;?>
    <!--  IF MOBILE     -->
    <?php if (true === Yii::$app->agent->isPhone() || true === Yii::$app->agent->isTablet()): ?>
        <!-- IF ANDROID -->
        <?php if (Yii::$app->agent->isAndroidOS()): ?>
        <a href="https://play.google.com/store/apps/details?id=com.android.chrome" class="c-browser">
            <img src="/media/browsers/chrome.png" alt="" class="c-browser__logo">
            <p class="c-browser__title a-text-lead a-color-dark">
                <?= Yii::t('frontend', 'Google Chrome'); ?>
            </p>
            <p class="c-browser__link c-external-link">
                <?= Yii::t('frontend', 'Скачать'); ?>
            </p>
        </a>
        <?php endif;?>
        <!-- IF IOS -->
        <?php if (Yii::$app->agent->isiOS()): ?>
        <a href="https://itunes.apple.com/us/app/google-chrome/id535886823?mt=8" class="c-browser">
            <img src="/media/browsers/chrome.png" alt="" class="c-browser__logo">
            <p class="c-browser__title a-text-lead a-color-dark">
                <?= Yii::t('frontend', 'Google Chrome'); ?>
            </p>
            <p class="c-browser__link c-external-link">
                <?= Yii::t('frontend', 'Скачать'); ?>
            </p>
        </a>
        <?php endif;?>
    <?php endif;?>
    </div>
  </div>
</div>
