<?php

namespace backend\assets;

use yii\web\AssetBundle;

class BackendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/app.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\widgets\PjaxAsset',
        'common\assets\AdminLte',
        'common\assets\Html5shiv',
        'backend\assets\TagsinputAsset',
    ];
}
