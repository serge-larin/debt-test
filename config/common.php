<?php
/**
 * Common config file for Yii2 application
 *
 * @author Serge Larin <serge.larin@gmail.com>
 * @link http://assayer.pro/
 * @copyright 2015 Assayer Pro Company
 * @license http://opensource.org/licenses/LGPL-3.0
 */

return [
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'charset' => 'UTF-8',
    'name' => 'Dept test task',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                ],
            ],
            'keyPrefix' => 'my-app',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                '' => '/site/index',
                '<_a:error>' => 'site/<_a>',
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
    ],
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Module',
        ],
        'debt' => [
            'class' => 'app\modules\debt\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
    ],
];
