<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%debt}}".
 *
 * @property integer $debt_id
 * @property string $debt_sum
 * @property string $debt_comment
 * @property integer $debt_person
 * @property string $debt_created_at
 *
 * @property Person $debtPerson
 */
class Debt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%debt}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['debt_sum', 'debt_comment', 'debt_person'], 'required'],
            [['debt_sum'], 'number'],
            [['debt_person'], 'integer'],
            [['debt_created_at'], 'safe'],
            [['debt_comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'debt_id' => 'Идентификатор',
            'debt_sum' => 'Сумма долга',
            'debt_comment' => 'Примечание',
            'debt_person' => 'Персона',
            'debt_created_at' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebtPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'debt_person']);
    }
}
