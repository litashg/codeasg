<?php

Yii::setAlias('@api', realpath(__DIR__ . '/../../api'));

/**
 * Setting url aliases
 */
Yii::setAlias('@apiUrl', getenv('API_HOST_INFO') . getenv('API_BASE_URL'));

\yii\base\Event::on('yii\base\Controller', 'beforeAction', function(\yii\base\ActionEvent $event) {
    if($event->action instanceof \yii\web\ErrorAction) {
        return;
    }

    /** @var yii\filters\ContentNegotiator $negotiator */
    $negotiator = Yii::createObject([
        'class' => 'yii\filters\ContentNegotiator',
        'languages' => array_keys(\common\modules\i18n\Module::getAvailableLocales()),
        'languageParam' => 'lang',
    ]);

    /** @var yii\base\ActionEvent $event */
    $negotiator->attach($event->action);
    $negotiator->negotiate();
});