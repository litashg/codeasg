<?php

use yii\db\Migration;

class m180305_123037_video_block_table extends Migration
{
    const TABLE_NAME = '{{%video_block}}';
    const TABLE_I18N_NAME = '{{%video_block_i18n}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if(\Yii::$app->db->schema->getTableSchema(self::TABLE_NAME) === null) {
            $this->createTable(self::TABLE_NAME, [
                'id' => $this->primaryKey(),
                'image_path' => $this->string(255)->defaultValue(null),
                'video_path' => $this->string(255)->notNull(),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'status' => $this->smallInteger(2)->notNull()->defaultValue(\common\modules\videoBlock\models\Video::STATUS_ACTIVE),
            ], $tableOptions);
        }

        $entityIdField = 'video_block_id';
        if(\Yii::$app->db->schema->getTableSchema(self::TABLE_I18N_NAME) === null) {
            $this->createTable(self::TABLE_I18N_NAME, [
                $entityIdField => $this->integer()->notNull(),
                'lang_id' => $this->string(2)->notNull(),
                'image_title' => $this->string(255)->defaultValue(null),
                'image_alt' => $this->string(255)->defaultValue(null),
                "PRIMARY KEY ($entityIdField, lang_id)",
            ], $tableOptions);

            $baseTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_NAME));
            $i18nTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_I18N_NAME));

            $fkName = "fk_{$baseTable}_{$i18nTable}_" . $entityIdField;
            $this->execute("ALTER TABLE ".self::TABLE_I18N_NAME."
                ADD CONSTRAINT {$fkName}
                FOREIGN KEY ($entityIdField) REFERENCES ".self::TABLE_NAME." (id) ON DELETE CASCADE;");
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_I18N_NAME);
        $this->dropTable(self::TABLE_NAME);
    }
}