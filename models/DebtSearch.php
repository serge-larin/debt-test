<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Debt;

/**
 * DebtSearch represents the model behind the search form about `app\models\Debt`.
 */
class DebtSearch extends Debt
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['debt_id', 'debt_person'], 'integer'],
            [['debt_sum'], 'number'],
            [['debt_comment', 'debt_created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Debt::find()->joinWith('debtPerson');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [ 'debt_person' => SORT_ASC ],
            ],
        ]);
        $dataProvider->sort->attributes['debt_person'] = [
            'asc' => ['person.person_last_name' => SORT_ASC],
            'desc' => ['person.person_last_name' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'debt_id' => $this->debt_id,
            'debt_sum' => $this->debt_sum,
            'debt_person' => $this->debt_person,
            'debt_created_at' => $this->debt_created_at,
        ]);

        $query->andFilterWhere(['like', 'debt_comment', $this->debt_comment]);

        return $dataProvider;
    }
}
