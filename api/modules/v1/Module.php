<?php

namespace api\modules\v1;

use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\web\Response;

/**
 * @SWG\Swagger(
 *     host=SWAGGER_API_HOST,
 *     basePath="/",
 *     schemes={SCHEME},
 *     @SWG\Info(
 *         version="1.0",
 *         title=SWAGGER_API_TITLE,
 *         @SWG\Contact(name=PROJECT_NAME, url=FRONTEND_HOST),
 *     ),
 *     @SWG\Definition(
 *      definition="Exception",
 *      required={"code", "message"},
 *      @SWG\Property(
 *          property="name",
 *              type="string",
 *              example="Internal Server Error"
 *          ),
 *          @SWG\Property(
 *              property="code",
 *              type="integer",
 *              format="int32",
 *              example=0
 *          ),
 *          @SWG\Property(
 *              property="message",
 *              type="string",
 *              example="An internal server error occurred."
 *          ),
 *          @SWG\Property(
 *              property="status",
 *              type="integer",
 *              example=500
 *          )
 *     ),
 *     @SWG\Definition(
 *      definition="ValidationError",
 *      required={"field", "message"},
 *      @SWG\Property(
 *          property="field",
 *              type="string",
 *              example="username"
 *          ),
 *          @SWG\Property(
 *              property="message",
 *              type="string",
 *              example="Field required and can't be empty"
 *          )
 *     ),
 * )
 */

/**
 * @SWG\Parameter(
 *     parameter="lang",
 *     name="lang",
 *     description="Language param",
 *     in="query",
 *     type="string",
 *     required=false,
 *     default=DEFAULT_LANGUAGE,
 *     enum={LANGUAGES},
 * )
 * @SWG\Parameter(
 *     parameter="limit",
 *     name = "limit",
 *     in = "query",
 *     description = "Limit items on page",
 *     required = false,
 *     type = "integer",
 *     default = 6,
 * )
 * @SWG\Parameter(
 *     parameter="offset",
 *     name = "offset",
 *     in = "query",
 *     description = "Offset of items",
 *     required = false,
 *     type = "integer",
 *     default = 0,
 * )
 */

/**
 * @SWG\Definition(
 *     definition="Picture",
 *     @SWG\Property(
 *          property="images",
 *          type="array",
 *          @SWG\Items(
 *              @SWG\Property(
 *                  property="original",
 *                  type="string",
 *                  description="Original image",
 *                  example="http://storage.bkw.loc/cache/1/fzdHHg7D_YPKOh_qsqvtf8L1OsypCIpL.jpg?s=1d7caf77b816f0fd47662e0d9439768a"
 *              ),
 *              @SWG\Property(
 *                  property="large",
 *                  type="string",
 *                  description="Large image",
 *                  example="http://storage.bkw.loc/cache/1/fzdHHg7D_YPKOh_qsqvtf8L1OsypCIpL.jpg?s=1d7caf77b816f0fd47662e0d9439768a"
 *              ),
 *              @SWG\Property(
 *                  property="desktop",
 *                  type="string",
 *                  description="Desktop image",
 *                  example="http://storage.bkw.loc/cache/1/fzdHHg7D_YPKOh_qsqvtf8L1OsypCIpL.jpg?s=1d7caf77b816f0fd47662e0d9439768a"
 *              ),
 *              @SWG\Property(
 *                  property="tablet",
 *                  type="string",
 *                  description="Tablet image",
 *                  example="http://storage.bkw.loc/cache/1/fzdHHg7D_YPKOh_qsqvtf8L1OsypCIpL.jpg?s=1d7caf77b816f0fd47662e0d9439768a"
 *              ),
 *              @SWG\Property(
 *                  property="mobile",
 *                  type="string",
 *                  description="Mobile image",
 *                  example="http://storage.bkw.loc/cache/1/fzdHHg7D_YPKOh_qsqvtf8L1OsypCIpL.jpg?s=1d7caf77b816f0fd47662e0d9439768a"
 *              ),
 *          ),
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Image title attribute",
 *          example="image title"
 *      ),
 *      @SWG\Property(
 *          property="alt",
 *          type="string",
 *          description="Image alt attribute",
 *          example="image alt"
 *      ),
 * )
 */

/**
 * @SWG\Definition(
 *     definition="Image",
 *     @SWG\Property(
 *          property="image",
 *          type="string",
 *          description="Full image path",
 *          example="http://storage.bkw.loc/cache/1/fzdHHg7D_YPKOh_qsqvtf8L1OsypCIpL.jpg?s=1d7caf77b816f0fd47662e0d9439768a"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Image title attribute",
 *          example="image title"
 *      ),
 *      @SWG\Property(
 *          property="alt",
 *          type="string",
 *          description="Image alt attribute",
 *          example="image alt"
 *      ),
 * )
 */
class Module extends \yii\base\Module
{

    /** @var string */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::class,
        ];

        return $behaviors;
    }
}
