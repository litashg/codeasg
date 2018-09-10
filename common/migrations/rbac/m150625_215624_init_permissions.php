<?php

use common\models\User;
use common\rbac\Migration;

class m150625_215624_init_permissions extends Migration
{
    public function up()
    {
        $adminRole = $this->auth->getRole(User::ROLE_ADMINISTRATOR);
        $rootRole = $this->auth->getRole(User::ROLE_ROOT);

        $loginToBackend = $this->auth->createPermission('loginToBackend');
        $this->auth->add($loginToBackend);

        $viewSystem = $this->auth->createPermission('viewSystem');
        $this->auth->add($viewSystem);

        $rootAccess = $this->auth->createPermission('rootAccess');
        $this->auth->add($rootAccess);

        $this->auth->addChild($rootRole, $loginToBackend);
        $this->auth->addChild($rootRole, $rootAccess);

        $this->auth->addChild($adminRole, $loginToBackend);
    }

    public function down()
    {
        $this->auth->remove($this->auth->getPermission('loginToBackend'));
    }
}
