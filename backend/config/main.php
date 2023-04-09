<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => null, // avaliable value 'left-menu', 'right-menu' and 'top-menu'
            'mainLayout' => '@app/views/layouts/main.php',
            'components' => [

            ],
        ],
        'log-reader' => [
            'class' => 'kriss\logReader\Module',
            'aliases' => [
                // 'Frontend Errors' => '@frontend/runtime/logs/app.log',
                'Backend Errors' => '@backend/runtime/logs/app.log',
                'Console Errors' => '@console/runtime/logs/app.log',
            ],
        ],
    ],
    'components' => [
        'rtc' => [
            'class' => \common\widgets\webrtc\models\RtcConfig::class,
            'wssServer' => getenv("RTC_WS_HOST"),
            'serverPath' => getenv("RTC_WS_PATH"),
            'webSocketPort' => getenv("RTC_WS_PORT"),
            'sipDomain' => getenv("RTC_SIP_DOMAIN"),
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@backend/views'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'class' => \common\components\User::class,
            'identityClass' => \common\models\User::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            'loginUrl' => ['site/login']
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/logs/backend/app.log'
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
//        'as access' => [
//            'class' => 'mdm\admin\components\AccessControl',
//            'allowActions' => [
//                'site/*',
////                'admin/*',
//            ]
//        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false, // Only considered when enablePrettyUrl is set to true
//            'rules' => [
//
//            ],
        ]
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'as access' => [
        'class' => \mdm\admin\components\AccessControl::class,
        'allowActions' => [
            'site/*',
            'debug/*',
        ],
    ],
    'params' => $params,
];
