<?php

$params = require(__DIR__ . '/params.php');
Yii::$classMap['Functions'] = '@app/libs/Functions.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site', //默认控制器

    //重命名控制器名称
    "controllerMap"=>[
        "chenlong"=>[
            "class"=>"app\controllers\IndexController",
            "enableCsrfValidation"=>false,
        ],
    ],
    'modules'=>[
        'admin'=>['class' => 'app\modules\admin\Admin']
    ],
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'request' => [
            'cookieValidationKey' => 'justdoloveyou_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '120.132.70.111',
            'port' =>6400,
            'database' => 0,
        ],
//        "session"=>[
//            "class"=>"yii\web\Dbsession",
//            "sessionTable"=>"my_session",
//        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
                'username' => 'php_chen@163.com',
                'password' => 'CHENlong9208',
                'port' => '25',
                'encryption' => 'tls',

            ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['php_chen@163.com'=>'justdoloveyou']
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

//        //restfulapi美化url
//        'urlManager' => [
//            'enablePrettyUrl' => true, //美化url
//            'showScriptName' => true, //隐藏index.php
//            'enableStrictParsing' => false, //要求网址严格匹配，需要输入rules。为false时不需要
//            'rules' => [
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'restful'],
//            ],
//        ],


    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
