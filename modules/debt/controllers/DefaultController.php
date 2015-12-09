<?php

namespace app\modules\debt\controllers;

use Yii;
use yii\web\Controller;
use app\models\Person;
use app\models\DebtSearch;
use app\models\Debt;

class DefaultController extends Controller
{
    public function actionIndex($id="")
    {
        $searchModel = new DebtSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $person = null;
        if (!empty($id)) {
            $person = $this->findModel($id);
        }
        return $this->render('index', [
            'person' => $person,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'newDebt' => new Debt(['debt_person' => $id]),
        ]);
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страница не найдена');
        }
    }

}
