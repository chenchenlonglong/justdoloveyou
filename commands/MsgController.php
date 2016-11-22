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
}