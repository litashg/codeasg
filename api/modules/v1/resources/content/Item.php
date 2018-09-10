<?php

namespace api\modules\v1\resources\content;

use yii\helpers\ArrayHelper;

/**
 * @SWG\Definition(
 *      definition="ContentItem",
 *      @SWG\Property(
 *          property="id",
 *          type="int",
 *          description="Unique Id, autoincrement",
 *          example=65
 *      ),
 *      @SWG\Property(
 *          property="type",
 *          type="string",
 *          enum={"text","tags","image","flag","in-frame"},
 *          example="text"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          type="string",
 *          description="Content title",
 *          example="Status"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          type="string",
 *          description="Content description",
 *          example="Status description"
 *      ),
 *      @SWG\Property(
 *          property="tags",
 *          type="array",
 *          items="$ref:Tag",
 *          example={"Company","Digital"}
 *      ),
 *      @SWG\Property(
 *          property="image",
 *          type="object",
 *          description="Item image",
 *          ref="#/definitions/Image",
 *      ),
 * )
 */
class Item extends \common\modules\contents\models\Item
{

    /**
     * @return string
     */
    protected function getTypeName(): string
    {
        $types = [
            self::TYPE_TEXT => 'text',
            self::TYPE_TAGS => 'tags',
            self::TYPE_IMAGE => 'image',
            self::TYPE_FLAG => 'flag',
            self::TYPE_IN_FRAME => 'in-frame',
        ];

        return $types[$this->type];
    }

    public function fields()
    {
        $result = [
            'id',
            'type' => function (Item $model) {
                return $model->getTypeName();
            },
        ];

        if($this->isTypeText()) {
            $result = ArrayHelper::merge($result, [
                'title',
                'description',
            ]);
        }

        if($this->isTypeTags()) {
            $result = ArrayHelper::merge($result, [
                'title',
                'tags' => function(Item $model) {
                    return $model->getTagsAsArray();
                },
            ]);
        }

        if($this->isTypeImage()) {
            $result['image'] = function(Item $model) {
                return [
                    'image' => $model->getImage(),
                    'title' => $model->getImageTitle(),
                    'alt' => $model->getImageAlt(),
                ];
            };
        }

        if($this->isTypeFlag()) {
            $result = ArrayHelper::merge($result, [
                'title',
                'image' => function(Item $model) {
                    return [
                        'image' => $model->getImage(),
                        'title' => $model->getImageTitle(),
                        'alt' => $model->getImageAlt(),
                    ];
                },
            ]);
        }

        if($this->isTypeInFrame()) {
            $result = ArrayHelper::merge($result, [
                'title',
                'description',
            ]);
        }

        return $result;
    }

}
