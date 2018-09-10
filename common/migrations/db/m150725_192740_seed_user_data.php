<?php

use common\models\User;
use yii\db\Migration;

class m150725_192740_seed_user_data extends Migration
{

    public static $TABLE_NAME = '{{%user}}';

    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->insert(self::$TABLE_NAME, [
            'id' => 5,
            'username' => 'root',
            'email' => 'root@aurocraft.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('root'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert(self::$TABLE_NAME, [
            'id' => 6,
            'username' => 'admin',
            'email' => 'admin@bkw-group.com.ua',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'access_token' => Yii::$app->getSecurity()->generateRandomString(40),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->truncateTable(self::$TABLE_NAME);
    }
}
