<?php
//@console
namespace console\controllers;

use Yii;
use yii\helpers\Console;

class RbacController extends \yii\console\Controller
{
    public function actionInit()
    {
        //yii rbac/create-permission
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        Console::output('Removing All! RBAC.....');
    
        $view_form = $auth->createPermission('view_form');
        $view_form->description = 'view_form';
        $auth->add($view_form);
    
        $view_chart = $auth->createPermission('view_chart');
        $view_chart->description = 'view_chart';
        $auth->add($view_chart);

        $view_backend = $auth->createPermission('view_backend');
        $view_backend->description = 'view_backend';
        $auth->add($view_backend);
    
        $user = $auth->createRole('User');
        $auth->add($user);
        $auth->addChild($user,$view_form);

        $admin = $auth->createRole('Admin');
        $auth->add($admin);
        $auth->addChild($admin,$view_chart);
        $auth->addChild($admin, $user);
        $auth->addChild($admin,$view_backend);

        $developer = $auth->createRole('Developer');
        $auth->add($developer);
        $auth->addChild($developer, $admin);
    
        $auth->assign($developer, 1);
        $auth->assign($admin, 2);
        $auth->assign($user, 3);
    
        Console::output('Success! RBAC roles has been added.');
    }
}