<?php

namespace api\modules\v1\resources\directions;

/**
 * @SWG\Definition(
 *      definition="DirectionCompany",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="logo",
 *          type="object",
 *          ref="#/definitions/Image",
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Direction title",
 *          example="Distribution Direction"
 *      ),
 *      @SWG\Property(
 *          property="tags",
 *          type="array",
 *          items="$ref:Tag",
 *          example={"Company","Digital"}
 *      ),
 *      @SWG\Property(
 *          property="siteLink",
 *          type="string",
 *          example="http://admin.bkw.loc/directions/company/create?directionId=5"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          type="string",
 *          example="Company with more than 10 years of experience"
 *      ),
 *      @SWG\Property(
 *          property="note",
 *          type="string",
 *          description="EBA note text",
 *          example="EBA note text"
 *      ),
 *      @SWG\Property(
 *          property="noteImage",
 *          type="object",
 *          description="EBA note image",
 *          ref="#/definitions/Image",
 *      ),
 * )
 */
class Company extends \common\modules\directions\models\Company
{

    public function fields()
    {
        return [
            'id',
            'logo' => function (Company $model) {
                return [
                    'image' => $model->getLogo(),
                    'title' => $model->getLogoTitle(),
                    'alt' => $model->getLogoAlt(),
                ];
            },
            'title',
            'tags' => function(Company $model) {
                return $model->getTagsAsArray();
            },
            'siteLink',
            'description',
            'note',
            'noteImage' => function(Company $model) {
                return [
                    'image' => $model->getNoteImage(),
                    'title' => $model->getNoteImageTitle(),
                    'alt' => $model->getNoteImageAlt(),
                ];
            },
        ];
    }


}
