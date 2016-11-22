<?php
/**
 * author: chenlong
 * Date: 2016/11/22
 * Time: 14:25
 */

namespace app\models;


use yii\db\ActiveRecord;

class Restful extends  ActiveRecord
{
        public static  function  tableName(){
            return "{{restful}}";
        }
}