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
        $msg=Yii::$app->request->get("xuemei","");
        $alidayu= new AlidayuAdapter( $params["APP_KEY"],$params["APP_SERECT"]);
        $moblie="18228095926";
        $id="SMS_18225035";
        if(empty($msg)){
            $msg=json_encode(array("msg"=>"媳妇er,被我的真诚感动到吗！"));
        }
        $name="陈龙";
        $result= $alidayu->send_msg_with_templete($moblie,$id,$msg,$name);
    }

}