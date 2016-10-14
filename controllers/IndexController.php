<?php
/**
 * author: chenlong
 * Date: 2016/9/21
 * Time: 15:32
 */

namespace app\controllers;


use yii\web\Controller;

class IndexController extends  Controller
{
    public  function  actionIndex(){

        throw new \yii\web\BadRequestHttpException;
    }
}