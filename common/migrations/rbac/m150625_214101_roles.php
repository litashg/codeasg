<?php

use common\models\User;
use common\rbac\Migration;

class m150625_214101_roles extends Migration
{
    /**
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function up()
    {
        $this->auth->removeAll();

//        $user = $this->auth->createRole(User::ROLE_USER);
//        $this->auth->add($user);

        $admin = $this->auth->createRole(User::ROLE_ADMINISTRATOR);
        $this->auth->add($admin);
//        $this->auth->addChild($admin, $user);

        $root = $this->auth->createRole(User::ROLE_ROOT);
        $this->auth->add($root);
        $this->auth->addChild($root, $admin);
//        $this->auth->addChild($root, $user);

        $this->auth->assign($root, 5);
        $this->auth->assign($admin, 6);
    }

    /**
     * @return bool|void
     */
    public function down()
    {
        $this->auth->remove($this->auth->getRole(User::ROLE_ROOT));
        $this->auth->remove($this->auth->getRole(User::ROLE_ADMINISTRATOR));
    }
}
