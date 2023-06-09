<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'right-menu', // avaliable value 'left-menu', 'right-menu' and 'top-menu'
            'mainLayout' => '@frontend/views/layouts/main.php',
        ],
        'log-reader' => [
            'class'   => 'kriss\logReader\Module',
            'aliases' => [
                // 'Frontend Errors' => '@frontend/runtime/logs/app.log',
                'Backend Errors'  =>  '@app/logs/frontend/app.log',
                'Console Errors'  => '@console/runtime/logs/app.log',
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/logs/frontend/app.log'
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => '@frontend/views'
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [

            ],
        ],

    ],
    'as access'           => [
        'class'        => \mdm\admin\components\AccessControl::class,
        'allowActions' => [
            'site/*',
        ],
    ],
    'params' => $params,
];
