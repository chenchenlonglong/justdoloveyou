<?php
/**
 * author: chenlong
 * Date: 2016/10/20
 * Time: 11:29
 */

namespace app\models;


use yii\db\ActiveRecord;

class Restful extends  ActiveRecord
{
    public  static function tableName(){
        return "{{restful}}";
    }
}