<?php
/**
 * author: chenlong
 * Date: 2016/9/21
 * Time: 15:32
 */

namespace app\controllers;

use yii\web\ConflictHttpException;
use yii\web\Controller;
use Yii;
use yii\web\HttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\NotFoundHttpException;

class IndexController extends  Controller
{
    public  function  actionIndex(){

        //加解密方法
        $data="你好";
        $msg=base64_encode(Yii::$app->getSecurity()->encryptByPassword($data,"123456"));
        var_dump($msg);
        $msg=Yii::$app->security->decryptByPassword(base64_decode($msg),"123456");
        var_dump($msg);

    }

    public function  actionRequestAll(){
        throw new  NotAcceptableHttpException;
//            throw new NotFoundHttpException;
    }
}