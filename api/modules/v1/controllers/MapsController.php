<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\{ActiveController, Serializer, IndexAction};
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use api\modules\v1\resources\maps\Country;
use api\modules\v1\resources\maps\filter\{PointsFilter, CountriesFilter};

class MapsController extends ActiveController
{

    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\resources\maps\Point';

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
            'points' => ['GET'],
            'countries' => ['GET'],
        ];
    }

    /**
     * @var array
     */
    public $serializer = [
        'class' => Serializer::class,
    ];

    /**
     * @SWG\Get(
     *     path = "/v1/maps/points?type=production&status[]=active&status[]=plan",
     *     tags = {"Maps"},
     *     operationId = "points-list",
     *     summary = "GET: /v1/maps/points",
     *     description = "List of points on the map of Ukraine",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *      @SWG\Parameter(
     *          name="type",
     *          in="query",
     *          description="Point type",
     *          required=false,
     *          type="string",
     *          enum={"representation","production"},
     *      ),
     *      @SWG\Parameter(
     *          name="status[]",
     *          in="query",
     *          description="Point status",
     *          required=false,
     *          type="string",
     *          enum={"active","plan"},
     *      ),
     *      @SWG\Parameter(ref="#/parameters/lang"),
     *      @SWG\Response(
     *         response=200,
     *         description="Successful response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Point")
     *         ),
     *      ),
     *      @SWG\Response(
     *         response=500,
     *         description="Exception",
     *         @SWG\Schema(ref="#/definitions/Exception"),
     *      ),
     *)
     */
    /**
     * @SWG\Get(
     *     path = "/v1/maps/countries?status[]=active&status[]=plan",
     *     tags = {"Maps"},
     *     operationId = "countries-list",
     *     summary = "GET: /v1/maps/countries",
     *     description = "World Countries list",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *      @SWG\Parameter(
     *          name="status[]",
     *          in="query",
     *          description="Country status",
     *          required=false,
     *          type="string",
     *          enum={"active","plan","inactive"},
     *      ),
     *      @SWG\Parameter(ref="#/parameters/lang"),
     *      @SWG\Response(
     *         response=200,
     *         description="Successful response",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Country")
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
            'points' => [
                'class' => IndexAction::class,
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider'],
            ],
            'countries' => [
                'class' => IndexAction::class,
                'modelClass' => Country::class,
                'prepareDataProvider' => [$this, 'prepareCountryDataProvider'],
            ],
        ];
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareDataProvider()
    {
        $searchModel = new PointsFilter();

        return $searchModel->search(\Yii::$app->getRequest()->getQueryParams());
    }

    /**
     * @return ActiveDataProvider
     */
    public function prepareCountryDataProvider()
    {
        $searchModel = new CountriesFilter();

        return $searchModel->search(\Yii::$app->getRequest()->getQueryParams());
    }

}
