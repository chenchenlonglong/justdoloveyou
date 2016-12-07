<?php
/**
 * author: chenlong
 * Date: 2016/11/16
 * Time: 16:24
 */

namespace app\commands;


use yii\console\Controller;
use yii\curl\Curl;

class MsgController extends  Controller
{
    public function  actionIndex(){
        $curl = new Curl();
    }

    public  function  actionGet_result(){
        $curl= new Curl();
        $num=0;
        for($i=0;$i<=2000;$i++){
            $result=$curl->get("http://test.order.sochepiao.com/index.php?r=trip/send_bouns&msign=leyou@hcp");
            if($result==1){
                $num++;
            }
        }
        echo $num;
    }
}