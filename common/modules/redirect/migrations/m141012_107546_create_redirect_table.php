<?php

use yii\db\Migration;

class m141012_107546_create_redirect_table extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        if(\Yii::$app->db->schema->getTableSchema('redirect') === null) {
            $this->createTable('{{%redirect}}', [
                'id' => $this->primaryKey(),
                'from_url' => $this->text(),
                'to_url' => $this->text(),
                'code' => $this->integer(3),
                'status' => $this->smallInteger(2)->notNull(),
            ], $tableOptions);
        }
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable('{{%redirect}}');
    }
}
