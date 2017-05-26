<?php
/**
 * author: chenlong
 * Date: 2017/5/17
 * Time: 10:24
 */

namespace app\controllers;


use yii\web\Controller;
use Yii;

class RedisController extends Controller
{
    public $enableCsrfValidation = false;

    public function  actionString()
    {
        #redis存储字符串
        $redis = Yii::$app->redis;
        $redis->set("6400_chen_01", "111");
        print_r($redis->get("6400_name"));
    }

    public function actionHash()
    {
        #Redis的哈希键值对的集合。 Redis的哈希值是字符串字段和字符串值之间的映射，所以它们被用来表示对象
        $redis = Yii::$app->redis;
        //键值的形式
        $redis->hmset('6400_chen_02', "filed", "value", "filed1", 'value2');
        $data = $redis->hgetall('6400_chen');
        var_dump($data);
    }

    public function actionList()
    {
        #Redis的列表是简单的字符串列表，排序插入顺序。可以添加元素到Redis列表的头部或尾部。
        $redis = Yii::$app->redis;
        Yii::$app->redis->rpush('list', 'aaa');
        Yii::$app->redis->rpush('list', 'bbb');
        Yii::$app->redis->rpush('list', 'ccc');
        $data = $redis->lrange("list", 0, 100);
        var_dump($data);
    }

    public function actionSets()
    {
        #有序集合 1,2,3 表示顺序
        #Redis集合是字符串的无序集合。在Redis中可以添加，删除和测试文件是否存在在O(1)的时间复杂度的成员
        $redis = Yii::$app->redis;
        $redis->zadd('6400_chen_03', 1, 'chen');
        $redis->zadd('6400_chen_03', 2, 'chen_2');
        
        $redis->zadd('6400_chen_03', 3, 'chen_2');
        $data = $redis->zrange('6400_chen_03', 0, 4);
        var_dump($data);
    }

    public function actionKey()
    {
        $redis = Yii::$app->redis;
//        Yii::$app->redis->set('name', 'yii-china');
//        $redis->expire("name",10);
        $data = $redis->get("name");
        var_dump($data);
    }
}