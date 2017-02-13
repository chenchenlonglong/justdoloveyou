<?php
/**
 * author: chenlong
 * Date: 2017/2/13
 * Time: 11:35
 */

namespace app\controllers;


class PermissionController extends BaseController
{
    public  function  actionCreate_permission(){
            $auth = \Yii::$app->authManager;
            var_dump($auth);
    }
}