<?php
/**
 * Database connection file for Yii2 application
 *
 * @author Serge Larin <serge.larin@gmail.com>
 * @link http://assayer.pro/
 * @copyright 2015 Assayer Pro Company
 * @license http://opensource.org/licenses/LGPL-3.0
 */

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=debt',
    'username' => 'USER',
    'password' => 'PASSWORD',
    'charset' => 'utf8',
    'tablePrefix' => '',
    'emulatePrepare' => true,
    'attributes' => [
        PDO::MYSQL_ATTR_LOCAL_INFILE => true,
    ],
];
