<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Frontend application asset
 */
class FrontendAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@frontend/web';

    /**
     * @var array
     */
    public $css = [
        'style/master.css?ver.1.2.2',
    ];

    /**
     * @var array
     */
    public $js = [
        'scripts/master.js?ver.1.2.2'
    ];

    /**
     * @var array
     */
    public $depends = [];
}
