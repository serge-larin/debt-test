<?php

namespace app\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use app\models\Person;
use yii\db\Expression;

/**
 * Класс AutocompleteController
 */

class AutocompleteController extends Controller
{
    public function actionPerson($query)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $fullName = new Expression('CONCAT(`person_last_name`, " ", `person_first_name`, " ", `person_second_name`)');

        $model = Person::find()->select(['full_name' => $fullName, 'person_id'])
            ->where(['like', $fullName, $query])
            ->orderBy('full_name')->asArray()->all();

        return array_map(
            function ($value) {
                return [
                    'id' => $value['person_id'],
                    'value' => $value['full_name'],
                ];
            },
            $model
        );
    }
}
