<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180710_170103_create_base_tables
 */
class m180710_170103_create_base_tables extends Migration
{
    const TABLE_TECHNOLOGY_NAME      = '{{%technologies}}';
    const TABLE_TECHNOLOGY_I18N_NAME = '{{%technologies_i18n}}';
    const TABLE_CATEGORY_NAME        = '{{%categories}}';
    const TABLE_CATEGORY_I18N_NAME   = '{{%categories_i18n}}';
    const TABLE_ARTICLE_NAME         = '{{%articles}}';
    const TABLE_ARTICLE_I18N_NAME    = '{{%articles_i18n}}';

    /**
     * {@inheritdoc}
     */
    public function Up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if (\Yii::$app->db->schema->getTableSchema(self::TABLE_TECHNOLOGY_NAME) === null) {
            $this->createTable(self::TABLE_TECHNOLOGY_NAME, [
                'id'                   => Schema::TYPE_PK,
                'slug'                 => Schema::TYPE_STRING . '(55) NOT NULL',
                'status'               => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at'           => Schema::TYPE_DATETIME,
                'updated_at'           => Schema::TYPE_DATETIME,
            ], $tableOptions);
        }

        $entityIdField = 'technology_id';
        if (\Yii::$app->db->schema->getTableSchema(self::TABLE_TECHNOLOGY_I18N_NAME) === null) {
            $this->createTable(self::TABLE_TECHNOLOGY_I18N_NAME, [
                $entityIdField => $this->integer()->notNull(),
                'lang_id' => $this->string(2)->notNull(),
                'title' => $this->string(255)->defaultValue(null),
                'description' => $this->string(255)->defaultValue(null),
                'body' => $this->text()->defaultValue(null),
                "PRIMARY KEY ($entityIdField, lang_id)",
        ], $tableOptions);

            $baseTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_TECHNOLOGY_NAME));
            $i18nTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_TECHNOLOGY_I18N_NAME));

            $fkName = "fk_{$baseTable}_{$i18nTable}_" . $entityIdField;
            $this->execute("ALTER TABLE ".self::TABLE_TECHNOLOGY_I18N_NAME."
                ADD CONSTRAINT {$fkName}
                FOREIGN KEY ($entityIdField) REFERENCES ".self::TABLE_TECHNOLOGY_NAME." (id) ON DELETE CASCADE;");
        }

        if (\Yii::$app->db->schema->getTableSchema(self::TABLE_CATEGORY_NAME) === null) {
            $this->createTable(self::TABLE_CATEGORY_NAME, [
                'id'                    => Schema::TYPE_PK,
                'technology_id'         => Schema::TYPE_INTEGER,
                'slug'                  => Schema::TYPE_STRING . '(55) NOT NULL',
                'status'                => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at'            => Schema::TYPE_DATETIME,
                'updated_at'            => Schema::TYPE_DATETIME,
            ], $tableOptions);
        }

        $entityIdField = 'category_id';
        if (\Yii::$app->db->schema->getTableSchema(self::TABLE_CATEGORY_I18N_NAME) === null) {
            $this->createTable(self::TABLE_CATEGORY_I18N_NAME, [
                $entityIdField => $this->integer()->notNull(),
                'lang_id' => $this->string(2)->notNull(),
                'title' => $this->string(255)->defaultValue(null),
                'description' => $this->string(255)->defaultValue(null),
                "PRIMARY KEY ($entityIdField, lang_id)",
            ], $tableOptions);

            $baseTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_CATEGORY_NAME));
            $i18nTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_CATEGORY_I18N_NAME));

            $fkName = "fk_{$baseTable}_{$i18nTable}_" . $entityIdField;
            $this->execute("ALTER TABLE ".self::TABLE_CATEGORY_I18N_NAME."
                ADD CONSTRAINT {$fkName}
                FOREIGN KEY ($entityIdField) REFERENCES ".self::TABLE_CATEGORY_NAME." (id) ON DELETE CASCADE;");
        }

        if (\Yii::$app->db->schema->getTableSchema(self::TABLE_ARTICLE_NAME) === null) {
            $this->createTable(self::TABLE_ARTICLE_NAME, [
                'id'                    => Schema::TYPE_PK,
                'category_id'           => Schema::TYPE_INTEGER,
                'slug'                  => Schema::TYPE_STRING . '(55) NOT NULL',
                'status'                => $this->smallInteger()->notNull()->defaultValue(10),
                'created_at'            => Schema::TYPE_DATETIME,
                'updated_at'            => Schema::TYPE_DATETIME,
            ], $tableOptions);
        }

        $entityIdField = 'article_id';
        if (\Yii::$app->db->schema->getTableSchema(self::TABLE_ARTICLE_I18N_NAME) === null) {
            $this->createTable(self::TABLE_ARTICLE_I18N_NAME, [
                $entityIdField => $this->integer()->notNull(),
                'lang_id' => $this->string(2)->notNull(),
                'title' => $this->string(255)->defaultValue(null),
                'body' => $this->text()->defaultValue(null),
                "PRIMARY KEY ($entityIdField, lang_id)",
            ], $tableOptions);

            $baseTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_ARTICLE_NAME));
            $i18nTable = strtolower(\yii\helpers\Inflector::classify(self::TABLE_ARTICLE_I18N_NAME));

            $fkName = "fk_{$baseTable}_{$i18nTable}_" . $entityIdField;
            $this->execute("ALTER TABLE ".self::TABLE_ARTICLE_I18N_NAME."
                ADD CONSTRAINT {$fkName}
                FOREIGN KEY ($entityIdField) REFERENCES ".self::TABLE_ARTICLE_NAME." (id) ON DELETE CASCADE;");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function Down()
    {
        $this->dropTable(self::TABLE_ARTICLE_I18N_NAME);
        $this->dropTable(self::TABLE_ARTICLE_NAME);
        $this->dropTable(self::TABLE_CATEGORY_I18N_NAME);
        $this->dropTable(self::TABLE_CATEGORY_NAME);
        $this->dropTable(self::TABLE_TECHNOLOGY_I18N_NAME);
        $this->dropTable(self::TABLE_TECHNOLOGY_NAME);
    }
}
