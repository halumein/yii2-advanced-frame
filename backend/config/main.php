<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'flowershop-backend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/admin',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['gii', 'log', 'debug'],
    'modules' => [
        'users' => [
            'class' => 'vova07\users\Module',
            'requireEmailConfirmation' => false, // By default is true. It mean that new user will need to confirm their email address.
            'robotEmail' => 'my@robot.email', // E-mail address from that will be sent all `users` emails.
            'robotName' => 'My Robot Name', // By default is `Yii::$app->name . ' robot'`.
            'activationWithin' => 86400, // The time before a sent activation token becomes invalid.
            'recoveryWithin' => 14400, // The time before a sent recovery token becomes invalid.
            'recordsPerPage' => 10, // Users pe page.
            'adminRoles' => ['superadmin', 'admin'], // User roles that can access backend module.
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1'],
        ],
        'debug' => [
            'class' => 'yii\debug\Module',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/admin',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'vova07\users\models\User',
            'loginUrl' => ['/users/admin/login']  // For backend app
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => [
                'user',
                'admin',
                'superadmin'
            ],
            'itemFile' => '@vova07/rbac/data/items.php',
            'assignmentFile' => '@vova07/rbac/data/assignments.php',
            'ruleFile' => '@vova07/rbac/data/rules.php',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
