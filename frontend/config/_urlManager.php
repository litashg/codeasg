<?php

return [
    'class' => '\common\components\UrlManager',

    'languageSessionKey' => '_locale',
    'languageCookieName' => '_locale',
    'languageParam' => '_lang',

    'enableLanguageDetection' => true,
    'enableDefaultLanguageUrlCode' => false,

    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'normalizer' => [
        'class' => 'yii\web\UrlNormalizer',
        // use temporary redirection instead of permanent for debugging
        'action' => \yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
    ],
    'ignoreLanguageUrlPatterns' => [
        '#^sitemap/default/index#' => '#^sitemap.xml#'
    ],
    'rules' => [
        'sitemap.xml' => 'sitemap/default/index',

        '/' => 'site/index',
        '/browser-outdated' => 'browser-outdated/index',

        [
            'pattern' => 'layout/<slug>',
            'route' => 'layout/index',
            'class' => 'yii\web\UrlRule',
        ],
    ]
];
