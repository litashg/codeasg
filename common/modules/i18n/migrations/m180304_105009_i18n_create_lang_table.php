<?php

use yii\db\Migration;
use lav45\translate\LocaleHelperTrait;
use common\modules\i18n\models\Lang;

class m180304_105009_i18n_create_lang_table extends Migration
{
    use LocaleHelperTrait;

    public $langArr = [
        [
            'code' => 'ua',
            'locale' => 'uk-UA',
            'name' => 'UKR',
            'status' => Lang::STATUS_ACTIVE,
            'order' => 0
        ],
        [
            'code' => 'ru',
            'locale' => 'ru-RU',
            'name' => 'RUS',
            'status' => Lang::STATUS_ACTIVE,
            'order' => 1
        ],
        [
            'code' => 'en',
            'locale' => 'en-US',
            'name' => 'ENG',
            'status' => Lang::STATUS_ACTIVE,
            'order' => 2
        ]
    ];

    /**
     * @var string
     */
    public $tableName;

    public function init()
    {
        parent::init();

        $this->tableName = Lang::tableName();
    }

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if(\Yii::$app->db->schema->getTableSchema($this->tableName) === null) {

            $this->createTable($this->tableName, [
                'id' => $this->primaryKey(),
                'code' => $this->string(2)->notNull()->unique(),
                'locale' => $this->string(8)->notNull(),
                'name' => $this->string(32)->notNull(),
                'order' => $this->integer(),
                'status' => $this->smallInteger()
            ], $tableOptions);

            $this->createIndex('lang_name_idx', '{{%lang}}', 'name', true);
            $this->createIndex('lang_status_idx', '{{%lang}}', 'status');

            foreach ($this->langArr as $lang){
                $this->insert($this->tableName, [
                    'code' => $lang['code'],
                    'locale' => $lang['locale'],
                    'name' => $lang['name'],
                    'status' => $lang['status'],
                    'order' => 1
                ]);
            }

        }
    }

    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}