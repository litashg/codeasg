<?php

namespace common\modules\cropper\assets;

use yii\web\AssetBundle;

class CropperAsset extends AssetBundle
{
    public $sourcePath = '@bower/cropper/dist';
    public $js = [
        'cropper.js'
    ];
    public $css = [
        'cropper.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
