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
//        'redis' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => '112.126.90.51',
//            'port' =>6400,
//            'database' => 0,
//        ],
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        //restfulapi美化url
        'urlManager' => [
            'enablePrettyUrl' => false, //美化url
            'showScriptName' => true, //隐藏index.php
            'enableStrictParsing' => false, //要求网址严格匹配，需要输入rules。为false时不需要
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'restful'],
            ],
        ],

    ],
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
