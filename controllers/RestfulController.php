<?php
/**
 * author: chenlong
 * Date: 2016/11/22
 * Time: 14:26
 */

namespace app\controllers;

//继承rest下的activecntroller
use yii\rest\ActiveController;

class RestfulController extends  ActiveController
{
    //重写modelClass 知道控制器处理数据的模型
    public  $modelClass="app\models\Restful";

}