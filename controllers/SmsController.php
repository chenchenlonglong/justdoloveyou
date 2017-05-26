<?php
/**
 * author: chenlong
 * Date: 2016/10/14
 * Time: 10:00
 */

namespace app\controllers;


use app\libs\AlidayuAdapter;
use yii\web\Controller;
use yii;


class SmsController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @desc 获得天气信息
     */
    public  function  actionGet_weather(){
        header("Content-type: text/html; charset=utf-8");
        $host =Yii::$app->params["URL"]["weather"];
        $method = "GET";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . Yii::$app->params["ALIYUN"]["APP_CODE"]);
        $city =urlencode("成都");
        $url = $host . "?" . "city=".$city;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $result=strstr(curl_exec($curl),"{");
        curl_close($curl);
       $result=json_decode($result,true);
        if($result["msg"]=="ok"){
            $this->send_msg($result["result"]);
        }
    }

    /**
     * @desc 发送短信
     * @param $result
     */
    private  function  send_msg($result){
        $params=Yii::$app->params["ALIDAYU"];
        $alidayu= new AlidayuAdapter( $params["APP_KEY"],$params["APP_SERECT"]);
        $moblie=Yii::$app->params["Mobile"]["dear"];
        $id=Yii::$app->params["SMS_ID"]["weather"];
        $msg=json_encode([
            "date"=>$result["date"],
            "week"=>$result["week"],
            "weather"=>$result["weather"],
            "templow"=>$result["templow"],
            "temphigh"=>$result["temphigh"],
            "humidity"=>$result["humidity"],
            "winddirect"=>$result["winddirect"],
            "windpower"=>$result["windpower"],
        ]);
        $name="陈龙天气提醒";
        $result_= $alidayu->send_msg_with_templete($moblie,$id,$msg,$name);
        var_dump($result_);
    }



    public  function  actionSend_mail(){
        $mail= Yii::$app->mailer->compose();
        $mail->setTo('1004076836@qq.com');
        $mail->setSubject("陈龙欢迎您的光临");
        $mail->setTextBody('　中新网北京5月5日电 3日开始，中国北方大部分地区遭遇今年以来最强沙尘天气过程。根据监测，受沙尘影响的地区涉及15省份，沙尘覆盖面积已达到217万平方公里，北方多城PM10浓度“爆表”。今日，北方大部分地区将有大风天气，其中北京地区阵风可达8、9级。明起，北方沙尘天气将逐步结束。

图片来源：中央气象台官网图片来源：中央气象台官网
　　沙尘天气影响全国半数省份 覆盖面积超200万平方公里

　　这次大范围影响北方地区的强沙尘天气，可谓来势汹汹，大气能见度不断降低。针对沙尘来袭，4日，中央气象台两次发布沙尘暴蓝色预警。

　　最新的气象预报显示，4日夜间至5日，北方大部将先后出现4~6级风，阵风8~9级。

　　这个时段内，内蒙古中东部、华北北部、东北地区西部等地局地阵风风力可达10级，新疆南疆盆地、内蒙古、甘肃东部、宁夏、陕西中北部、山西大部、河北大部、北京、山东大部、河南、吉林西部、辽宁西部、苏皖北部、湖北西北部等地的部分地区将伴有扬沙或浮尘天气，其中内蒙古中东部部分地区有沙尘暴。

　　根据上述预报，沙尘天气将影响全国15个省份，按照中央电视台4日晚间《天气预报》节目的介绍，沙尘波及的面积已达到217万平方公里，这也意味着，超过五分之一国土遭遇了沙尘过程。

5月4日，北京城区遭沙尘笼罩。中新社记者 富田 摄5月4日，北京城区遭沙尘笼罩。中新社记者 富田 摄
　　多地PM10“爆表” 北京局地PM10浓度破两千

　　受这次强沙尘天气影响，北方多地空气质量达到重污染或者严重污染程度，一些城市的PM10浓度陡增，甚至“爆表”。

　　据监测，3日23时，内蒙古的呼和浩特、乌兰察布，PM10的浓度达到或超过了2500微克/立方米。根据中国天气网的报道，4日早上8点，中国北方出现横跨西北到东北的沙尘区，多地局部地区最低能见度仅300米。齐齐哈尔、锡林浩特、张家口、大同、鄂尔多斯、金昌多地PM10浓度均超过1000微克/立方米。

　　在受此次强沙尘天气影响较重的内蒙古，内蒙古环保厅数据显示，4日内蒙古呼和浩特市、包头市、巴彦淖尔市、乌海市等地AQI（空气质量指数）均在500以上，为严重污染。

　　就北京来看，4日凌晨4点多，沙尘主体到达北京，4日清晨，北京多个监测站点的PM10浓度破千。根据监测，4日8时，北京城六区的PM10浓度已达到1582微克/立方米，西北部、东南部和西南部的PM10均已超过2000微克/立方米。这也是北京近两年来遭遇的最严重沙尘天气过程。

5月4日，内蒙古地区迎来今年最强沙尘暴，图为车辆在沙尘中缓慢行驶。李爱平 摄5月4日，内蒙古地区迎来今年最强沙尘暴，图为车辆在沙尘中缓慢行驶。李爱平 摄
　　三北防护林挡不住强沙尘？专家释疑

　　对于此次强沙尘的起源地，据报道，中央气象台环境气象中心高级工程师张碧辉表示，前期，沙源地气温偏高、降雨偏少，为起沙提供了有利条件；同时，3日蒙古国和内蒙古大风天气，引发了大范围沙尘天气。沙尘最初从蒙古国开始，逐渐向中国传输。在传输过程中，中国的沙源地也会起沙，在高空气流引导下共同影响下游地区。

　　对于舆论中有关三北防护林为何挡不住强沙尘的疑问，张碧辉表示，三北防护林等措施主要是改善局地气候、起到防风固沙的作用，但是对于远距离、高空传输的沙尘作用有限。就以本次影响北京的沙尘来说，是通过高空5000米的偏西气流传输而来，防护林的高度难以阻挡沙尘。

　　据统计，截至目前，今年北方地区已出现7次沙尘天气过程，少于近十年同期平均次数（8.4次），与去年同期持平（7次）。

5月4日，北京城区遭沙尘笼罩。中新网记者 金硕 摄5月4日，北京城区遭沙尘笼罩。中新网记者 金硕 摄
　　今日北京阵风可达8~9级 明起沙尘或影响南方地区

　　沙尘天气何时散去？根据上述气象预报，今天，北方大部分地区仍将是大风和扬沙相伴，根据预报，北方大部将先后出现4~6级风，阵风8~9级。

　　北京市气象台4日16时35分发布大风黄色预警信号，受冷空气影响，预计5日白天北京将有5、6级偏北风，阵风可达8、9级。

　　就空气质量来看，根据环境保护部宣传教育司官方微博“环保部发布”的消息，未来三天（5日-7日），大气扩散条件总体有利，全国大部空气质量优良，北方部分地区以良至轻度污染为主。

　　受强北风影响，沙尘主要影响地区逐步南移，6日起华北地区沙尘天气将逐步结束，但受沙尘传输影响，6日-7日南方部分地区可能出现短时中至重度污染。

　　针对北方沙尘的传输影响，以上海为例，上海市环境监测中心、上海中心气象台4日发布气象提醒，预计5日傍晚起，上海市空气质量将受到北方沙尘污染输送影响，5日夜间至6日上午沙尘将明显影响上海，空气质量以轻度至中度污染为主，短时可达重度污染，首要污染物为PM10。（完） ');   //发布纯文字文本
//        $mail->setHtmlBody("<br>问我我我我我");    //发布可以带html标签的文本
        if($mail->send())
            echo "success";
        else
            echo "false";
        die();
    }

}