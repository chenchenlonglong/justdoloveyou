<?php
/**
 * author: chenlong
 * Date: 2016/11/22
 * Time: 14:26
 */

namespace app\controllers;

//继承rest下的activecntroller
use app\models\Restful;
use yii\rest\ActiveController;

class RestfulController extends  ActiveController
{
    //重写modelClass 知道控制器处理数据的模型
    public  $modelClass="app\models\Restful";

    public  function  actionChenlong(){
        return 111;
    }


    public  function  actionView($id){
        return Restful::findOne(["id"=>$id]);
    }

    //可覆盖actions()方法配置或禁用这些操作
    //yii\rest\IndexAction: 按页列出资源;
    //yii\rest\ViewAction: 返回指定资源的详情;
    //yii\rest\CreateAction: 创建新的资源;
    //yii\rest\UpdateAction: 更新一个存在的资源;
    //yii\rest\DeleteAction: 删除指定的资源;
    //yii\rest\OptionsAction: 返回支持的HTTP方法.

//    public  function  actions(){
//        $actions=parent::actions();
//        unset($actions["'delete'"],$actions["'create'"]);
//        // 使用"prepareDataProvider()"方法自定义数据provider
//        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
//        return $actions;
//    }
}