<?php
/**
 * author: chenlong
 * Date: 2017/5/3
 * Time: 17:46
 */

namespace app\commands;


use yii\console\Controller;
use Yii;
use app\libs\AlidayuAdapter;

class WeatherController extends  Controller
{
    /**
     * @desc 获得天气信息
     */
    public  function  actionGet_weather(){
        header("Content-type: text/html; charset=utf-8");
        $host =Yii::$app->params["URL"]["weather"];
        $method = "GET";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . Yii::$app->params["ALIYUN"]["APP_CODE"]);
        $city =urlencode("成都");
        $url = $host . "?" . "city=".$city;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $result=strstr(curl_exec($curl),"{");
        curl_close($curl);
        $result=json_decode($result,true);
        if($result["msg"]=="ok"){
            $this->send_msg($result["result"]);
        }
    }

    /**
     * @desc 发送短信
     * @param $result
     */
    private  function  send_msg($result){
        $params=Yii::$app->params["ALIDAYU"];
        $alidayu= new AlidayuAdapter( $params["APP_KEY"],$params["APP_SERECT"]);
        $moblie=Yii::$app->params["Mobile"]["dear"];
        $id=Yii::$app->params["SMS_ID"]["weather"];
        $msg=json_encode([
            "date"=>$result["date"],
            "week"=>$result["week"],
            "weather"=>$result["weather"],
            "templow"=>$result["templow"],
            "temphigh"=>$result["temphigh"],
            "humidity"=>$result["humidity"],
            "winddirect"=>$result["winddirect"],
            "windpower"=>$result["windpower"],
        ]);
        $name="陈龙天气提醒";
        $result_= $alidayu->send_msg_with_templete($moblie,$id,$msg,$name);
        if($result_==0){
            echo "SUCCESS"."\n";
        }else{
            echo "FAIL"."\n";
        }
    }
}