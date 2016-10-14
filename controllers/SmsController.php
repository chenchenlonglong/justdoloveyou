<?php
/**
 * author: chenlong
 * Date: 2016/10/14
 * Time: 10:00
 */

namespace app\controllers;

use TopClient;
use yii\web\Controller;
use Yii;
use AlibabaAliqinFcSmsNumSendRequest;

class SmsController extends Controller
{
    public $enableCsrfValidation = false;
    public  $appkey;
    public  $secertkey;

    public  function  init(){
        $this->appkey=Yii::$app->params["ALIDAYU"]["APP_KEY"];
        $this->secertkey=Yii::$app->params["ALIDAYU"]["APP_SERECT"];
    }

    public  function actionSend_sms(){
        $alidayu= new TopClient();
        $req=new AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("陈龙");
        $req->setSmsParam("{\"msg\":\"我想你啦\"}");
        $req->setRecNum("18228095926");
        $req->setSmsTemplateCode("	SMS_18225035");
        $resp = $alidayu->execute($req);
    }

}