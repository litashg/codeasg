<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use common\modules\i18n\Module;

class ApiController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        $url = parse_url(env('API_HOST_INFO'));

        define("SWAGGER_API_HOST", $url['host']);
        define("SCHEME", $url['scheme']);
        define("FRONTEND_HOST", Yii::getAlias('@frontendUrl'));
        define("SWAGGER_API_TITLE", Yii::$app->name . " API documentation");
        define("PROJECT_NAME", Yii::$app->name);

        $languages = Module::getAvailableLocales();

        define("DEFAULT_LANGUAGE", Module::getDefaultLanguage());
        define("LANGUAGES", implode(" | ", array_keys($languages)));

        return [
            'docs' => [
                'class' => 'yii2mod\swagger\SwaggerUIRenderer',
                'restUrl' => Url::to(['api/json-schema']),
                'view' => 'docs',
            ],
            'json-schema' => [
                'class' => 'yii2mod\swagger\OpenAPIRenderer',
                'cache' => null,
                'scanDir' => [
                    Yii::getAlias('@api'),
                ],
            ],
        ];
    }
}
