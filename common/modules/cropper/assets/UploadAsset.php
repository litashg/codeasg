<?php

namespace common\modules\cropper\assets;

use yii\web\AssetBundle;

class UploadAsset extends AssetBundle
{
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'trntv\filekit\widget\BlueimpFileuploadAsset'
    ];

    public $sourcePath = __DIR__ . '/../web/plugins/upload-kit';

    public $css = [
        YII_DEBUG ? 'css/upload-kit.css' : 'css/upload-kit.min.css'
    ];

    public $js = [
        'js/upload-kit.js'
    ];
}
