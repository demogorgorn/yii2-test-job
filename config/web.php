<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'se-y89TWp57Mj4CQlUW-FNbLccpWqUYE',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/signin'],

        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'suffix' => '',
            'rules' => [
                'page/<page:\d+>' => 'book/index',
                '/' => 'book/index',

                'category/<a:(update|delete)>/<id:\d+>' => 'category/<a>',
                'category/create' => 'category/create',
                'category/<id:\d+>' => 'category/view',
                'categories/<page:\d+>' => 'category/index',
                'categories' => 'category/index',

                'book/<a:(update|delete)>/<id:\d+>' => 'book/<a>',
                'book/create' => 'book/create',
                'book/<id:\d+>' => 'book/view',
                'books/<page:\d+>' => 'book/index',
                'books' => 'book/index',

                'user/<id:\d+>' => 'user/view',
                'users/<page:\d+>' => 'user/index',
                'users' => 'user/index',

                'about' => 'site/about',
            ]
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
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
