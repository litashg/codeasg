<?php

namespace common\modules\seo\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use lav45\translate\{TranslatedBehavior, TranslatedTrait};
use trntv\filekit\behaviors\UploadBehavior;
use common\modules\seo\models\query\PageQuery;
use common\grid\EnumColumn;
use paulzi\jsonBehavior\JsonBehavior;
use paulzi\jsonBehavior\JsonValidator;

/**
 * This is the model class for table "seo_pages".
 *
 * @property integer $id
 * @property string $url
 * @property string $route
 * @property EnumColumn $og_type
 * @property string $og_image_path
 * @property string $twitter_image_path
 * @property EnumColumn $index
 * @property string $verification_tags
 * @property EnumColumn $follow
 * @property integer $created_at
 * @property integer $updated_at
 *
 *
'id'                   => Schema::TYPE_PK,
'slug'                 => Schema::TYPE_STRING . '(55) NOT NULL',
'status'               => $this->smallInteger()->notNull()->defaultValue(10),
'created_at'           => Schema::TYPE_DATETIME,
'updated_at'           => Schema::TYPE_DATETIME,
 * @property TechnologyI18n $technologyI18n
 *
 * Translated attribute
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class Technology extends ActiveRecord
{
    use TranslatedTrait;

    const OG_TYPES = [
        'Website' => 'website',
        'Article' => 'article',
        'Blog'    => 'blog',
        'Company' => 'company'
    ];

    const INDEX_TYPES = [
        'index' => 'index',
        'noindex' => 'noindex'
    ];

    const FOLLOW_TYPES = [
        'follow' => 'follow',
        'nofollow' => 'nofollow'
    ];

    /**
     * @var string
     */
    public $og_image;

    /**
     * @var string
     */
    public $twitter_image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seo_pages}}';
    }

    /**
     * @return PageQuery
     */
    public static function find()
    {
        return new PageQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'url' => Yii::t('backend', 'Meta-Url'),
            'title' => Yii::t('backend', 'Meta-Title'),
            'description' => Yii::t('backend', 'Meta-Description'),
            'keywords' => Yii::t('backend', 'Meta-Keywords'),
            'verification_tags' => Yii::t('backend', 'Verification Tags'),
            'status' => Yii::t('backend', 'Status'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => JsonBehavior::class,
                'attributes' => ['verification_tags'],
            ],
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
                'translateRelation' => 'pageI18n',
                'sourceLanguage' => \common\modules\i18n\Module::getDefaultLanguage(),
                'translateAttributes' => [
                    'title',
                    'keywords',
                    'description',
                ]
            ],
            'meta_og_image' => [
                'class' => UploadBehavior::class,
                'attribute' => 'og_image',
                'pathAttribute' => 'og_image_path',
            ],
            'meta_twitter_image' => [
                'class' => UploadBehavior::class,
                'attribute' => 'twitter_image',
                'pathAttribute' => 'twitter_image_path',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['title', 'description','index', 'follow', 'keywords'], 'string'],
            [['url', 'og_image_path', 'twitter_image_path', ], 'string', 'max' => 255],
            ['og_type', 'default', 'value' => 'website'],
            [['og_image', 'twitter_image', 'keywords', 'verification_tags'], 'safe'],
            [['verification_tags'], JsonValidator::class],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageI18n()
    {
        return $this->hasMany(PageI18n::class, ['seo_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getMetaTitle(): string
    {
        return (string)$this->translation->title;
    }

    /**
     * @return string
     */
    public function getMetaKeywords(): string
    {
        return (string)$this->translation->keywords;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return (string)$this->translation->description;
    }

    /**
     * @return string
     */
    public function getMetaOgImage(): string
    {
        if(!empty($this->og_image_path)) {
            return \Yii::$app->fileStorage->baseUrl . '/' . $this->og_image_path;
        }

        return '';
    }

    /**
     * @return string
     */
    public function getMetaTwitterImage(): string
    {
        if(!empty($this->twitter_image_path)) {
            return \Yii::$app->fileStorage->baseUrl . '/' . $this->twitter_image_path;
        }

        return '';
    }

    /**
     * @return array
     */
    public static function getOGTypeList()
    {
        return array_flip(self::OG_TYPES);
    }

    /**
     * @return array
     */
    public static function getIndexList()
    {
        return array_flip(self::INDEX_TYPES);
    }

    /**
     * @return array
     */
    public static function getFollowList()
    {
        return array_flip(self::FOLLOW_TYPES);
    }

    /**
     * @return string
     */
    public function getMetaRobots(): ?string
    {
        $data = '';
        if(!empty($this->getIndex())) {
            $data .= $this->getIndex();
        }
        if(!empty($this->getIndex()) && !empty($this->getFollow())) {
            $data .= ', ';
        }
        if(!empty($this->getFollow())) {
            $data .= $this->getFollow();
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getIndex(): ?string
    {
        return (string)$this->index;
    }

    /**
     * @return string
     */
    public function getFollow(): ?string
    {
        return (string)$this->follow;
    }

    /**
     * @return array
     */
    public function getVerificationTags(): ?array
    {
        return $this->verification_tags->toArray();
    }
}
