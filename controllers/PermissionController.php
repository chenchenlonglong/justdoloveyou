<?php
/**
 * author: chenlong
 * Date: 2017/2/13
 * Time: 11:35
 */

namespace app\controllers;


class PermissionController extends BaseController
{

    public  function  actionCreate_permission($name){
            $auth = \Yii::$app->authManager;
            $createPost = $auth->createPermission($name);
           $createPost->description = '创建了 ' . $name. ' 权限';
        $auth->add($createPost);
    }
}