<?php
/**
 * author: chenlong
 * Date: 2016/11/22
 * Time: 14:25
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\Link;
use yii\web\Linkable;

//class Restful extends  ActiveRecord

class Restful extends ActiveRecord implements Linkable
{
        //链接资源类通过实现yii\web\Linkable 接口来支持HATEOAS，
        //该接口包含方法 yii\web\Linkable::getLinks() 来返回 yii\web\Link 列表，典型情况下应返回包含代表本资源对象URL的 self 链接，
        //例如
        public  function  getLinks(){
            return [
                Link::REL_SELF => Url::to(['index/change', 'id' => $this->id], true),
            ];

        }


        public static  function  tableName(){
            return "{{restful}}";
        }


// 明确列出每个字段，适用于你希望数据表或模型属性修改时不导致你的字段修改（保持后端API兼容性）
//        public    function fields(){
//            return [
//                "id",
//                "c_name"=>"name",
//            ];
//        }


// 过滤掉一些字段，适用于你希望继承父类实现同时你想屏蔽掉一些敏感字段public
        public  function fields(){
            $fields=parent::fields();
            unset($fields['auth_key'], $fields['password_hash'], $fields['password_reset_token']);
            return $fields;
        }

        public  function  extraFields(){
            return ["'profile'"];
        }
}