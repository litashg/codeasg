<?php

use yii\db\Migration;

/**
 * Class m180903_134512_change_seo_page_table
 */
class m180903_134512_change_seo_page_table extends Migration
{
    const TABLE_NAME = '{{%seo_pages}}';

    public function safeUp()
    {
        $this->alterColumn(self::TABLE_NAME, 'route', $this->string(255));

    }

    public function safeDown()
    {
        $this->alterColumn(self::TABLE_NAME, 'route',  $this->string(255)->notNull());
    }
}
