<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'homeUrl' => '/',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
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
        ]
    ],
    'components' => [
      'request' => [
            'baseUrl' => '',
      ],
      'user' => [
          'class' => 'yii\web\User',
          'identityClass' => 'vova07\users\models\User',
          'loginUrl' => ['/users/guest/login']  // For frontend app
          // 'loginUrl' => ['/users/admin/login']  // For backend app
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
