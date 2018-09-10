<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seo_pages`.
 */
class m180601_101800_create_seo_pages_table extends Migration
{
    const TABLE_NAME = '{{%seo_pages}}';
    const TABLE_I18N_NAME = '{{%seo_pages_i18n}}';

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
                'url' => $this->string(255)->notNull(),
                'route' => $this->string(255)->notNull(),
                'og_type' => "ENUM('website', 'article', 'blog', 'company')",
                'og_image_path' => $this->string(255)->defaultValue(null),
                'twitter_image_path' => $this->string(255)->defaultValue(null),
                'index' => "ENUM('index', 'noindex')",
                'follow' => "ENUM('follow', 'nofollow')",
                'verification_tags' => $this->text()->defaultValue(null),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);
        }

        $entityIdField = 'seo_id';
        if(\Yii::$app->db->schema->getTableSchema(self::TABLE_I18N_NAME) === null) {
            $this->createTable(self::TABLE_I18N_NAME, [
                $entityIdField => $this->integer()->notNull(),
                'lang_id' => $this->string(2)->notNull(),
                'title' => $this->text()->defaultValue(null),
                'keywords' => $this->text()->defaultValue(null),
                'description' => $this->text()->defaultValue(null),
                "PRIMARY KEY ($entityIdField, lang_id)",
            ], $tableOptions);

            $fkName = "fk_seo_pages_seo_pages_i18n_" . $entityIdField;
            $this->execute("ALTER TABLE ".self::TABLE_NAME." ALTER og_type SET DEFAULT 'website'");
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
