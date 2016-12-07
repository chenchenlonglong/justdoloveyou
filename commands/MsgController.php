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
    public function  actionIndex()
    {
        $curl = new Curl();
    }

    public function  actionGet_result()
    {
        $curl = new Curl();
        $num_1 = $num_2 = $num_3 = 0;
        for ($i = 0; $i < 100; $i++) {
            $result = $curl->get("http://test.order.sochepiao.com/index.php?r=trip/send_bouns&msign=leyou@hcp");
            $msg[] = $result;
            if ($result == 1) {
                $num_1++;
            }
            if ($result == 2) {
                $num_2++;
            }
            if ($result == 3) {
                $num_3++;
            }
        }
        echo "最大红包的次数:" . $num_1 . "<br/>";
        echo "普通红包的次数:" . $num_2 . "<br/>";
        echo "优惠券的次数:" . $num_3 . "<br/>";
    }
}