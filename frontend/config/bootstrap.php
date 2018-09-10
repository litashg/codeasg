<?php

use yii\base\Event;
use common\modules\seo\models\Page;
use common\modules\seo\widgets\MetaTags;

Event::on('yii\base\Controller', 'beforeAction', function(\yii\base\ActionEvent $event) {

    $url = '/' .  \Yii::$app->request->getPathInfo();
    if (empty($url)) {
        return;
    }

    $seoPage = Page::find()->url($url)->one();

    if(!empty($seoPage)) {
        MetaTags::widget(['model' => $seoPage]);
    }
});

Event::on('yii\base\Controller', 'beforeAction', function(\yii\base\ActionEvent $event) {

    $agent = Yii::$app->agent;
    $browser = $agent->browser();
    $version = $agent->version($browser);

    if(true === $agent->isDesktop()) {
        if($event->action->controller->id === 'browser-outdated') {

            if (($browser == 'IE' && false === version_compare($version, 11, '<')) ||
                ($browser == 'Edge' && false === version_compare($version, 14, '<')) ||
                ($browser == 'Firefox' && false === version_compare($version, 44, '<')) ||
                ($browser == 'Chrome' && false === version_compare($version, 48, '<')) ||
                ($browser == 'Safari' && false === version_compare($version, 10, '<'))
            ) {
                return $event->action->controller->redirect(['site/index']);
            }

            return;
        }

        if (($browser == 'IE' && true === version_compare($version, 11, '<')) ||
            ($browser == 'Edge' && true === version_compare($version, 14, '<')) ||
            ($browser == 'Firefox' && true === version_compare($version, 44, '<')) ||
            ($browser == 'Chrome' && true === version_compare($version, 48, '<')) ||
            ($browser == 'Safari' && true === version_compare($version, 10, '<'))
        ) {
            return $event->action->controller->redirect(['browser-outdated/index']);
        }
    }

    if(true === $agent->isMobile()) {
        if($event->action->controller->id === 'browser-outdated') {

            if (($browser == 'Safari' && false === version_compare($version, '9.3', '<'))
            ) {
                return $event->action->controller->redirect(['site/index']);
            }

            return;
        }

        if (($browser == 'Safari' && true === version_compare($version, '9.3', '<'))
        ) {
            return $event->action->controller->redirect(['browser-outdated/index']);
        }
    }

});
