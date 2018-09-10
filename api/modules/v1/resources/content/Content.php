<?php

namespace api\modules\v1\resources\content;

/**
 * @SWG\Definition(
 *      definition="Content",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Content title",
 *          example="Status"
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          type="string",
 *          enum={"text","images","flags","in-frame"},
 *          example="text"
 *      ),
 *      @SWG\Property(
 *          property="items",
 *          type="array",
 *          @SWG\Items(ref="#/definitions/ContentItem"),
 *      ),
 * )
 */
class Content extends \common\modules\contents\models\Content
{

    /**
     * @return string
     */
    protected function getTypeName(): string
    {
        $types = [
            self::TYPE_TEXT => 'text',
            self::TYPE_IMAGES => 'images',
            self::TYPE_FLAGS => 'flags',
            self::TYPE_IN_FRAME => 'in-frame',
        ];

        return $types[$this->type];
    }

    public function fields()
    {
        return [
            'id',
            'title',
            'type' => function (Content $model) {
                return $model->getTypeName();
            },
            'items' => function (Content $model) {
                $itemType = Item::TYPE_TEXT;

                if($model->isTypeText()) {
                    $itemType = [Item::TYPE_TEXT, Item::TYPE_TAGS];
                }

                if($model->isTypeImages()) {
                    $itemType = Item::TYPE_IMAGE;
                }

                if($model->isTypeFlags()) {
                    $itemType = Item::TYPE_FLAG;
                }

                if($model->isTypeInFrame()) {
                    $itemType = Item::TYPE_IN_FRAME;
                }

                $contents = Item::find()
                    ->where(['content_id' => $model->getId()])
                    ->andWhere(['type' => $itemType])
                    ->all();

                return $contents;
            },
        ];
    }

}
