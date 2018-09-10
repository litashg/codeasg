<?php
$config = [
    'homeUrl' => Yii::getAlias('@backendUrl'),
    'controllerNamespace' => 'backend\controllers',
    'sourceLanguage' => 'ua-UA',
    'language' => 'ua-UA',
    'defaultRoute' => 'sign-in/login',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => env('BACKEND_COOKIE_VALIDATION_KEY'),
            'baseUrl' => env('BACKEND_BASE_URL'),
        ],
        'user' => [
            'class' => yii\web\User::class,
            'identityClass' => common\models\User::class,
            'loginUrl' => ['sign-in/login'],
            'enableAutoLogin' => true,
            'as afterLogin' => common\behaviors\LoginTimestampBehavior::class,
        ],
    ],
    'modules' => [
        'i18n' => [
            'class' => common\modules\i18n\Module::class,
        ],
        'seo' => [
            'class' => common\modules\seo\Module::class,
        ],
        'redirect' => [
            'class' => common\modules\redirect\Module::class,
        ],
        'file' => [
            'class' => common\modules\file\Module::class,
        ],
        'system' => [
            'class' => backend\modules\system\Module::class,
        ],
        'translation' => [
            'class' => backend\modules\translation\Module::class,
        ],
        'rbac' => [
            'class' => backend\modules\rbac\Module::class,
            'defaultRoute' => 'rbac-auth-item/index',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'as globalAccess' => [
        'class' => common\behaviors\GlobalAccessBehavior::class,
        'rules' => [
            [
                'controllers' => ['sign-in'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['login'],
            ],
            [
                'controllers' => ['sign-in'],
                'allow' => true,
                'roles' => ['@'],
                'actions' => ['logout'],
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
                'roles' => ['?', '@'],
                'actions' => ['error'],
            ],
            [
                'controllers' => ['debug/default'],
                'allow' => true,
                'roles' => ['?'],
            ],
            [
                'controllers' => ['user'],
                'actions' => ['update', 'delete'],
                'matchCallback' => function (\yii\filters\AccessRule $rule, \yii\base\InlineAction $action) {
                    if (\Yii::$app->user->can('root') === false) {
                        $userId = Yii::$app->request->get('id');

                        if (true === in_array(
                                \common\models\User::ROLE_ROOT,
                                array_keys(Yii::$app->authManager->getAssignments($userId))
                            )) {
                            throw new \yii\web\ForbiddenHttpException();
                        }
                    }
                },
            ],
            [
                'controllers' => ['user'],
                'allow' => true,
                'roles' => ['administrator'],
            ],
            [
                'controllers' => ['user'],
                'allow' => false,
            ],
            [
                'allow' => true,
                'roles' => ['root', 'administrator'],
            ],
        ],
    ],
];

return $config;
