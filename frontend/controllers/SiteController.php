<?php

namespace frontend\controllers;

use yii\web\Controller;
use common\modules\pages\models\Page;
use common\modules\videoBlock\models\Video;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
        ];
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function actionIndex()
    {

    }

}
