<?php

namespace common\modules\redirect\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "seo_pages".
 *
 * @property integer $id
 * @property string $from_url
 * @property string $to_url
 * @property int $code
 */
class Redirect extends ActiveRecord
{

    const CODES_ARR = [
        '301' => '301',
        '302' => '302'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%redirect}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'from_url' => Yii::t('backend', 'From Url'),
            'to_url' => Yii::t('backend', 'To Url'),
            'status' => Yii::t('backend', 'Status'),
            'code' => Yii::t('backend', 'Code'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_url', 'to_url', 'code'], 'required'],
            [['from_url','to_url'], 'url', 'defaultScheme' => 'http'],
            [['from_url', 'to_url'], 'string', 'max' => 255],
            [['code'], 'integer']
        ];
    }

    /**
     * @return string
     */
    public function getFromUrl(): string
    {
        return $this->from_url;
    }

    /**
     * @return string
     */
    public function getToUrl(): string
    {
        return $this->to_url;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

}
