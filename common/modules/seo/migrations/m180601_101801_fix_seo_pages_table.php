<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seo_pages`.
 */
class m180601_101801_fix_seo_pages_table extends Migration
{
    const TABLE_NAME = '{{%seo_pages}}';
    const TABLE_I18N_NAME = '{{%seo_pages_i18n}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query1 = "ALTER TABLE ".self::TABLE_NAME." MODIFY `index` ENUM(' ', 'index', 'noindex') default 'index'";
        $this->execute($query1);
        $query2 = "ALTER TABLE ".self::TABLE_NAME." MODIFY `follow` ENUM(' ', 'follow', 'nofollow') default 'follow'";
        $this->execute($query2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $query1 = "ALTER TABLE ".self::TABLE_NAME." MODIFY `index` ENUM(' ', 'index', 'noindex') default 'index'";
        $this->execute($query1);
        $query2 = "ALTER TABLE ".self::TABLE_NAME." MODIFY `follow` ENUM(' ', 'follow', 'nofollow') default 'follow'";
        $this->execute($query2);
    }
}
