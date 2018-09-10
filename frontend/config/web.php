<?php

$config = [
    'homeUrl' => Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'site/index',
    'bootstrap' => [
        common\modules\redirect\components\RedirectPage::class,
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'request' => [
            'cookieValidationKey' => env('FRONTEND_COOKIE_VALIDATION_KEY')
        ],
        'geoip' => [
            'class' => 'lysenkobv\GeoIP\GeoIP'
        ],
        'agent' => [
            'class' => \Jenssegers\Agent\Agent::class
        ]
    ],
    'modules' => [
        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                \labcoding\pages\models\Page::class,
            ],
            'urls'=> [
                // your additional urls
//                [
//                    'loc' => '/news/index',
//                    'changefreq' => \himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
//                    'priority' => 0.8,
//                    'news' => [
//                        'publication'   => [
//                            'name'          => 'Example Blog',
//                            'language'      => 'en',
//                        ],
//                        'access'            => 'Subscription',
//                        'genres'            => 'Blog, UserGenerated',
//                        'publication_date'  => 'YYYY-MM-DDThh:mm:ssTZD',
//                        'title'             => 'Example Title',
//                        'keywords'          => 'example, keywords, comma-separated',
//                        'stock_tickers'     => 'NASDAQ:A, NASDAQ:B',
//                    ],
//                    'images' => [
//                        [
//                            'loc'           => 'http://example.com/image.jpg',
//                            'caption'       => 'This is an example of a caption of an image',
//                            'geo_location'  => 'City, State',
//                            'title'         => 'Example image',
//                            'license'       => 'http://example.com/license',
//                        ],
//                    ],
//                ],
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
    ],
];

return $config;
