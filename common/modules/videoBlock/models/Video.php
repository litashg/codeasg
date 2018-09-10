<?php

namespace common\modules\videoBlock\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use lav45\translate\TranslatedBehavior;
use lav45\translate\TranslatedTrait;
use common\modules\videoBlock\models\query\VideoQuery;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "video_block".
 *
 * @property integer $id
 * @property string $image_path
 * @property string $video_path
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 *
 * @property VideoI18n $videoBlockI18n
 *
 * Translated attribute
 * @property string    $image_title
 * @property string    $image_alt
 */
class Video extends ActiveRecord
{
    use TranslatedTrait;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    /**
     * @var
     */
    public $image;

    /**
     * @var
     */
    public $video;

    /**
     * @return array
     */
    public static function getStatuses() {
        return [
            self::STATUS_ACTIVE => \Yii::t('backend', 'Active'),
            self::STATUS_INACTIVE => \Yii::t('backend', 'Inactive'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%video_block}}';
    }

    /**
     * @return VideoQuery
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => time(),
            ],
            'i18n' => [
                'class' => TranslatedBehavior::class,
                'translateRelation' => 'videoI18n',
                'sourceLanguage' => \common\modules\i18n\Module::getDefaultLanguage(),
                'translateAttributes' => [
                    'image_title',
                    'image_alt',
                ]
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'image',
                'pathAttribute' => 'image_path',
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'video',
                'pathAttribute' => 'video_path',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['image_title', 'image_alt', 'image_path', 'video_path'], 'string', 'max' => 255],
            [['image', 'video'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('backend', 'Id'),
            'image' => \Yii::t('backend', 'Image'),
            'video' => \Yii::t('backend', 'Video'),
            'image_title' => \Yii::t('backend', 'Image Title'),
            'image_alt' => \Yii::t('backend', 'Image Alt'),
            'status' => \Yii::t('backend', 'Status'),
            'created_at' => Yii::t('backend', 'Created Date'),
            'updated_at' => Yii::t('backend', 'Updated Date'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideoI18n()
    {
        return $this->hasMany(VideoI18n::class, ['video_block_id' => 'id']);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getImageTitle(): string
    {
        return (string) $this->translation->image_title;
    }

    /**
     * @return string
     */
    public function getImageAlt(): string
    {
        return (string) $this->translation->image_alt;
    }

    /**
     * @return string
     */
    public function getImagePath(): string
    {
        return (string) $this->image_path;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return (string) Yii::$app->fileStorage->baseUrl . '/' . $this->image_path;
    }

    /**
     * @return string
     */
    public function getVideo(): string
    {
        if(!empty($this->video_path)) {
            return (string) Yii::$app->fileStorage->baseUrl . '/' . $this->video_path;
        }
        return (string) $this->video_path;
    }
}
