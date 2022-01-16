<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    /**
     * @throws \yii\base\Exception
     * @throws \Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createUser"
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a user';
        $auth->add($createUser);

        // добавляем разрешение "updateUser"
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update user';
        $auth->add($updateUser);

        // добавляем роль "ambassador" и даём роли разрешение "createUser"
        $ambassador = $auth->createRole('ambassador');
        $auth->add($ambassador);
        $auth->addChild($ambassador, $createUser);

        // добавляем роль "admin" и даём роли разрешение "updateUser"
        // а также все разрешения роли "ambassador"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $ambassador);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($ambassador, 2);
        $auth->assign($admin, 1);
    }
}