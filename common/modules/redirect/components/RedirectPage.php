<?php

namespace common\modules\redirect\components;

use yii\base\BootstrapInterface;
use common\modules\redirect\models\Redirect;

class RedirectPage implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $currentUrl = \Yii::$app->urlManager->createAbsoluteUrl(\Yii::$app->getRequest()->getUrl());
        /** @var Redirect $redirect */
        $redirect = Redirect::find()
            ->andWhere(['from_url' => $currentUrl])
            ->one();

        if(!empty($redirect)) {
            \Yii::$app->getResponse()
                ->redirect($redirect->getToUrl(), $redirect->getCode())
                ->send();
            exit;
        }
    }
}
