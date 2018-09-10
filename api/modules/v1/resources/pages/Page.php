<?php

namespace api\modules\v1\resources\pages;

/**
 * @SWG\Response(
 *      response="Page",
 *      description="The basic page response",
 *      @SWG\Schema(ref="$/definitions/Page")
 * )
 */
/**
 * @SWG\Definition(
 *      definition="Page",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="url",
 *          type="string",
 *          description="Page url",
 *          example="/"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Page title",
 *          example="Main info page"
 *      ),
 *      @SWG\Property(
 *          property="body",
 *          type="string",
 *          description="Page text",
 *          example="Special people often have something special."
 *      ),
 * )
 */
class Page extends \common\modules\pages\models\Page
{

    public function fields()
    {
        return [
            'id',
            'url',
            'title',
            'body'
        ];
    }
}
