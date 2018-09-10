<?php

declare(strict_types=1);

namespace api\controllers;

use Yii;
use yii\web\{Controller, NotFoundHttpException};

class SiteController extends Controller
{
    /**
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->asJson([]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof \HttpException) {
            Yii::$app->response->setStatusCode($exception->getCode());
        } else {
            Yii::$app->response->setStatusCode(500);
        }

        return $this->asJson(
            [
                'error' => $exception->getMessage(),
                'code' => $exception->getCode()
            ]
        );
    }
}