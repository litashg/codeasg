<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\{ActiveController, Serializer, IndexAction};
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecordInterface;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use api\modules\v1\resources\pages\{Map, Main, About, Audit, History, Structure, Contacts};
use api\modules\v1\resources\pages\filter\PagesFilter;

class PagesController extends ActiveController
{

    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\pages\Page';

    /**
     * List of allowed domains.
     * Note: Restriction works only for AJAX (using CORS, is not secure).
     *
     * @return array List of domains, that can access to this API
     */
    public static function allowedDomains() {
        return [
            Yii::getAlias('@frontendUrl'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
                'cors' => [
                    // restrict access to domains:
                    'Origin' => static::allowedDomains(),
                    'Access-Control-Request-Method' => ['GET'],
                ],
            ],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function verbs()
    {
        return [
            'index' => ['GET']
        ];
    }

    /**
     * @var array
     */
    public $serializer = [
        'class' => Serializer::class,
    ];

    private $modelClassMap = [
        'main' => Main::class,
        'about' => About::class,
        'history' => History::class,
        'audit' => Audit::class,
        'structure' => Structure::class,
        'map' => Map::class,
        'contacts' => Contacts::class,
    ];

    /**
     * @SWG\Get(
     *     path = "/v1/pages",
     *     tags = {"Pages"},
     *     operationId = "pages-list",
     *     summary = "GET: /v1/pages",
     *     description = "Pages list",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *      @SWG\Parameter(ref="#/parameters/limit"),
     *      @SWG\Parameter(ref="#/parameters/offset"),
     *      @SWG\Parameter(ref="#/parameters/lang"),
     *      @SWG\Response(
     *         response=200,
     *         description="Successful response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Page")
     *         ),
     *      ),
     *      @SWG\Response(
     *         response=500,
     *         description="Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     *)
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider'],
            ],
        ];
    }

    /**
     * @SWG\Get(
     *     path = "/v1/pages/{url}",
     *     tags = {"Pages"},
     *     operationId = "pages-read",
     *     summary = "GET: /v1/pages/{url}",
     *     description = "Read page data by url",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(
     *         description = "Url of page to fetch",
     *         in = "path",
     *         name = "url",
     *         required = true,
     *         type = "string",
     *         enum={"main","about"},
     *     ),
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/Page",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @SWG\Get(
     *     path = "/v1/pages/main",
     *     tags = {"Pages"},
     *     operationId = "pages-read-main",
     *     summary = "GET: /v1/pages/main",
     *     description = "Read Main page data",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/MainPage",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @SWG\Get(
     *     path = "/v1/pages/about",
     *     tags = {"Pages"},
     *     operationId = "pages-read-about",
     *     summary = "GET: /v1/pages/about",
     *     description = "Read About page data",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/AboutPage",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @SWG\Get(
     *     path = "/v1/pages/history",
     *     tags = {"Pages"},
     *     operationId = "pages-read-history",
     *     summary = "GET: /v1/pages/history",
     *     description = "Read History page data",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/HistoryPage",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @SWG\Get(
     *     path = "/v1/pages/audit",
     *     tags = {"Pages"},
     *     operationId = "pages-read-audit",
     *     summary = "GET: /v1/pages/audit",
     *     description = "Read Audit page data",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/AuditPage",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @SWG\Get(
     *     path = "/v1/pages/structure",
     *     tags = {"Pages"},
     *     operationId = "pages-read-structure",
     *     summary = "GET: /v1/pages/structure",
     *     description = "Read company Structure page data",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/StructurePage",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @SWG\Get(
     *     path = "/v1/pages/map",
     *     tags = {"Pages"},
     *     operationId = "pages-read-map",
     *     summary = "GET: /v1/pages/map",
     *     description = "Read Geography page data",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/MapPage",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @SWG\Get(
     *     path = "/v1/pages/contacts",
     *     tags = {"Pages"},
     *     operationId = "pages-read-contacts",
     *     summary = "GET: /v1/pages/contacts",
     *     description = "Read Contacts page data",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(ref="#/parameters/lang"),
     *     @SWG\Response(
     *         response = 200,
     *         description="Successful response",
     *         ref="$/responses/ContactPage",
     *     ),
     *     @SWG\Response(
     *         response = 500,
     *         description = "Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     * )
     */

    /**
     * @param $url
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionRead($url)
    {
        /* @var $modelClass ActiveRecordInterface */
        $modelClass = $this->modelClassMap[$url] ?? $this->modelClass;

        if($url == 'main') {
            $url = '/';
        }

        $model = $modelClass::find()->url($url)->one();

        if (isset($model)) {
            return $model;
        }

        throw new NotFoundHttpException("Object not found: $url");
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $searchModel = new PagesFilter();

        return $searchModel->search(\Yii::$app->getRequest()->getQueryParams());
    }
}
