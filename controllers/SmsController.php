<?php
/**
 * author: chenlong
 * Date: 2016/10/14
 * Time: 10:00
 */

namespace app\controllers;


use app\libs\AlidayuAdapter;
use yii\web\Controller;
use yii;

class SmsController extends Controller
{
    public $enableCsrfValidation = false;


    public function actionSend_sms(){
        $params=[
            "APP_KEY"=>"23464833",
            "APP_SERECT"=>"605ae7dfc3b9bb1392498b1ca090e681",
        ];
        $msg=Yii::$app->request->get("xuemei","");
        $alidayu= new AlidayuAdapter( $params["APP_KEY"],$params["APP_SERECT"]);
        $moblie="18228095926";
        $id="SMS_18225035";
        if(empty($msg)){
            $msg=json_encode(array("msg"=>"我就知道！"));
        }
        $name="陈龙";
        $result= $alidayu->send_msg_with_templete($moblie,$id,$msg,$name);
        var_dump($result);
    }

}