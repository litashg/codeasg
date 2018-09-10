<?php

namespace common\modules\seo\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "seo_pages_i18n".
 *
 * @property integer $seo_id
 * @property string $lang_id
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class TechnologyI18n extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seo_pages_i18n}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seo_id', 'lang_id'], 'required'],
            [['seo_id', 'lang_id'], 'integer'],
            [['title', 'keywords', 'description'], 'string'],
        ];
    }
}
