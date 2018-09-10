<?php
$config = [
    'homeUrl' => Yii::getAlias('@apiUrl'),
    'controllerNamespace' => 'api\controllers',
    'defaultRoute' => 'site/index',
    'modules' => [
        'v1' => \api\modules\v1\Module::class
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'request' => [
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
        ]
    ],
];

return $config;
