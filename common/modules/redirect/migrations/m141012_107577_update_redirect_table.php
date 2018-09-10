<?php

use yii\db\Migration;

class m141012_107577_update_redirect_table extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->dropColumn('{{%redirect}}', 'status');

    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->addColumn('{{%redirect}}', 'status', $this->smallInteger(2)->notNull());
    }
}
