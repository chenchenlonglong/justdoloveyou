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


// 明确列出每个字段，适用于你希望数据表或模型属性修改时不导致你的字段修改（保持后端API兼容性）
        public    function fields(){
            return [
                "id",
                "name"=>"c_name",
            ];
        }
}