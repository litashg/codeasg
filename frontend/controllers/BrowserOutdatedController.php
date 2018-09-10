<?php

namespace frontend\controllers;

use yii\web\Controller;

class BrowserOutdatedController extends Controller
{
    public $layout = '@frontend/views/layouts/error';

    /**
     * @return string
     * @throws \Exception
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
