<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;

/**
 * UserController
 *
 * @uses ActiveController
 * @package app\modules\api]controllers
 */
class DebtController extends ActiveController
{
    public $modelClass = '\app\models\Debt';
}
