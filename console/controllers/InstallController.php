<?php
/**
 *
 * User: ThangDang
 * Date: 2019-01-22
 * Time: 10:27
 *
 */

namespace console\controllers;


use common\models\User;
use console\models\Signup;
use Yii;
use yii\console\Controller;
use yii\helpers\BaseConsole;

class InstallController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->user->setIdentity(new User());

        BaseConsole::output(BaseConsole::renderColoredString('%YAdd admin user %n'));
        $userName = $password = 'admin';
//        $fullName = 'Administrator';
        $email    = 'admin@lcs.com.vn';
        $validate = true;
        $user     = new Signup();
        do {
            if (!$validate) {
                BaseConsole::output(BaseConsole::renderColoredString('%r' . implode(PHP_EOL,
                        $user->getFirstErrors()) . '%n'));
            }
            
            $userName = BaseConsole::prompt(BaseConsole::renderColoredString('%cEnter username:%n'), [
                'required' => true,
                'default'  => $userName,
            ]);
            
            $password = BaseConsole::prompt(BaseConsole::renderColoredString('%cEnter password:%n'), [
                'required' => true,
                'default'  => $password,
            ]);
            
//            $fullName = BaseConsole::prompt(BaseConsole::renderColoredString('%cEnter full name:%n'), [
//                'required' => true,
//                'default'  => $fullName,
//            ]);
            
            $email = BaseConsole::prompt(BaseConsole::renderColoredString('%cEnter email:%n'), [
                'required' => true,
                'default'  => $email,
            ]);
            
            $confirm = 'Confirm data' . PHP_EOL;
            $confirm .= 'Username: ' . $userName . PHP_EOL;
            $confirm .= 'Email: ' . $email . PHP_EOL;
            $confirm .= 'Password: ' . $password . PHP_EOL;
            
            $user->email     = $email;
            $user->username  = $userName;
//            $user->full_name = $fullName;
            $user->password  = $password;
            $user->retypePassword  = $password;
        } while (($c = BaseConsole::select($confirm, [
                'y' => 'YES',
                'n' => 'NO',
                'q' => 'QUIT',
            ]) === 'n') || !($validate = $user->validate()));
        
        if ($confirm === 'q') {
            exit();
        }
       $user = $user->signup();
        

        $auth_manager = Yii::$app->getAuthManager();
        $role_admin = $auth_manager->getRole('Admin');
        if (!$role_admin) {
            //Add  roles
            $role_admin = new \yii\rbac\Role();
            $role_admin->name = 'Admin';
            $role_admin->type = \yii\rbac\Item::TYPE_ROLE;

            //Add route
            $route_admin = new \yii\rbac\Role();
            $route_admin->name = '/*';
            $route_admin->type = \yii\rbac\Item::TYPE_PERMISSION;

            $auth_manager->add($role_admin);
            $auth_manager->add($route_admin);
            $auth_manager->addChild($role_admin, $route_admin);
        }
        $auth_manager->assign($role_admin, $user->id);
        
        BaseConsole::output(BaseConsole::renderColoredString('%gCreated user success%n'));
    }
}