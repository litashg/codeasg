<?php

namespace api\modules\v1\resources\pages;

use yii\helpers\ArrayHelper;

/**
 * @SWG\Response(
 *      response="AboutPage",
 *      description="the AboutPage response",
 *      @SWG\Schema(
 *          ref="$/definitions/Page",
 *          @SWG\Property(
 *              property="footnote",
 *              type="string",
 *              description="Footnote text",
 *              example="Lorem ipsum dolor sit amet"
 *          ),
 *          @SWG\Property(
 *              property="footnoteImage",
 *              type="object",
 *              ref="#/definitions/FootnoteImageAbout"
 *          ),
 *          @SWG\Property(
 *              property="companies",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Company"),
 *          ),
 *          @SWG\Property(
 *              property="founders",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Founder"),
 *          ),
 *          @SWG\Property(
 *              property="seo",
 *              type="array",
 *              @SWG\Items(ref="#/definitions/Seo"),
 *          ),
 *      )
 * )
 *
 * @SWG\Definition(
 *      definition="Seo",
 *          @SWG\Property(
 *              property="metatitle",
 *              type="object",
 *              ref="#/definitions/Metatitle"
 *          ),
 *      ),
 * )
 *
 * @SWG\Definition(
 *      definition="Metatitle",
 *      type="string",
 *      description="Page metatitle",
 *      example="meta title example"
 *      ),
 * )
 *
 *  @SWG\Definition(
 *      definition="FootnoteImageAbout",
 *      @SWG\Property(
 *          property="image",
 *          type="string",
 *          description="Footnote Logo link",
 *          example="http://storage.bkw.loc/source/1/OD1sQRyWFhKPw61si1saPEZj_JCbn51W.svg"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Footnote image title attribute",
 *          example="image title"
 *      ),
 *      @SWG\Property(
 *          property="alt",
 *          type="string",
 *          description="Footnote image alt attribute",
 *          example="image alt"
 *      ),
 * )
 */
class About extends Page
{
    public function fields()
    {
        $fields = [
            'footnote',
            'footnoteImage' => function (Page $model) {
                return [
                    'image' => $model->getFootnoteImage(),
                    'title' => $model->getFootnoteImageTitle(),
                    'alt' => $model->getFootnoteImageAlt(),
                ];
            },
            'companies' => function() {
                return \api\modules\v1\resources\companies\Company::find()
                    ->orderBy(['order' => SORT_ASC])
                    ->all();
            },
            'founders' => function() {
                return \api\modules\v1\resources\founders\Founder::find()
                    ->orderBy(['order' => SORT_ASC])
                    ->all();
            },
            'seo' => function (Page $model) {
                return [
                    'meta_title' => (isset($model->seo)) ? $model->seo->getMetaTitle(): null,
                ];
            }
        ];

        return ArrayHelper::merge(parent::fields(), $fields);
    }
}
