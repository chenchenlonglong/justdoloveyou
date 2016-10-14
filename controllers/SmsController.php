<?php
/**
 * author: chenlong
 * Date: 2016/10/14
 * Time: 10:00
 */

namespace app\controllers;


use app\libs\AlidayuAdapter;
use yii\web\Controller;
use Yii;

class SmsController extends Controller
{
    public $enableCsrfValidation = false;


    public function actionSend_sms(){
        $params=Yii::$app->params["ALIDAYU"];
        $alidayu= new AlidayuAdapter( $params["APP_KEY"],$params["APP_SERECT"]);
        $moblie="18228095926";
        $id="SMS_18225035";
        $params=json_encode(array("msg"=>"媳妇我想你啦！"));
        $name="陈龙";
       $result= $alidayu->send_msg_with_templete($moblie,$id,$params,$name);
        var_dump($result);
    }

}