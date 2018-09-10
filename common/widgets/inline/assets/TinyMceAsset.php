<?php

namespace common\widgets\inline\assets;

use yii\web\AssetBundle;

class TinyMceAsset extends AssetBundle
{
    public $baseUrl = '@web';

    public $js = [
        'plugins/tinymce-dist/tinymce.min.js'
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
    ];
}
