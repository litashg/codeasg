<?php
return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        // Api
        [
            'pattern' => '/v1/pages/<url>',
            'route' => 'v1/pages/read',
        ],
    ]
];
