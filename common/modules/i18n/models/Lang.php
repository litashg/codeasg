<?php

namespace common\modules\i18n\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use lav45\translate\LocaleHelperTrait;
use common\modules\i18n\models\query\LangQuery;

/**
 * This is the model class for table "lang".
 *
 * @property integer $id
 * @property string $code
 * @property string $locale
 * @property string $name
 * @property integer $status
 *
 * @property array $statusList
 * @property string $statusName
 */
class Lang extends ActiveRecord
{
    use LocaleHelperTrait;

    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 2;

    const PATTERN = '[a-z]{2}';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lang}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'sjaakp\sortable\Sortable',
                'orderAttribute' => 'order'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'trim'],
            [['code'], 'required'],
            [['code'], 'string', 'min' => 2, 'max' => 2],
            [['code'], 'match', 'pattern' => '/^' . self::PATTERN . '$/'],
            [['code'], 'unique'],

            [['name'], 'trim'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
            [['name'], 'unique'],

            [['locale'], 'trim'],
            [['locale'], 'required'],
            [['locale'], 'string', 'max' => 8],

            [['order', 'status'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => array_keys($this->getStatusList())],

            [['code', 'status', 'locale'], function($attribute) {
                if ($this->isAttributeChanged($attribute, false) && $this->isSourceLanguage()) {
                    $this->addError($attribute, Yii::t('backend', 'This field is not editable.'));
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'code' => Yii::t('backend', 'Code'),
            'locale' => Yii::t('backend', 'Locale'),
            'name' => Yii::t('backend', 'Name'),
            'status' => Yii::t('backend', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return LangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LangQuery(get_called_class());
    }

    /**
     * @return bool
     */
    public function isSourceLanguage()
    {
        return $this->getOldAttribute('code') == $this->getPrimaryLanguage(Yii::$app->sourceLanguage);
    }

    /**
     * @return string[]
     */
    public static function getStatusList()
    {
        return [
            static::STATUS_ACTIVE => Yii::t('backend', 'Active'),
            static::STATUS_DISABLE => Yii::t('backend', 'Disable'),
        ];
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusList(), $this->status);
    }

    /**
     * @param bool $active default false so it is most often used in backend
     * @return array
     */
    public static function getListLocaleName($active = false)
    {
        $query = static::find()
            ->select(['name', 'locale'])
            ->orderBy('id DESC')
            ->indexBy('locale');

        if ($active === true) {
            $query->active();
        }

        return $query->column();
    }

    /**
     * @param bool $active default false so it is most often used in backend
     * @return array
     */
    public static function getList($active = false)
    {
        $query = static::find()
            ->select(['name', 'code'])
            ->orderBy(['order' => SORT_ASC])
            ->indexBy('code');

        if ($active === true) {
            $query->active();
        }

        return $query->column();
    }

    /**
     * @param bool $active default true so it is most often used in frontend
     * @return array
     */
    public static function getLocaleList($active = true)
    {
        $query = static::find()
            ->select(['locale', 'code'])
            ->orderBy('code DESC')
            ->indexBy('code');

        if ($active === true) {
            $query->active();
        }

        return $query->column();
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

}