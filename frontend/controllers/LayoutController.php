<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class LayoutController extends Controller
{

    /**
     * @param null $slug
     * @return string
     */
    public function actionIndex($slug = null)
    {
        return $this->render($slug, []);
    }
}
