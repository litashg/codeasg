<?php

namespace common\modules\videoBlock\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "video_block_i18n".
 *
 * @property string  $lang_id
 * @property integer $video_block_id
 * @property string  $image_title
 * @property string  $image_alt
 */
class VideoI18n extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_block_i18n}}';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_block_id', 'lang_id', 'image_title', 'image_alt'], 'required'],
            [['video_block_id', 'lang_id'], 'integer'],
            [['image_title', 'image_alt'], 'string'],
        ];
    }
}
