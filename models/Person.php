<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $person_id
 * @property string $person_first_name
 * @property string $person_second_name
 * @property string $person_last_name
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_first_name', 'person_second_name', 'person_last_name'], 'required'],
            [['person_first_name', 'person_second_name', 'person_last_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Идентификатор',
            'person_first_name' => 'Имя',
            'person_second_name' => 'Отчество',
            'person_last_name' => 'Фамилия',
        ];
    }

    public function getFullName()
    {
        return implode(' ', [$this->person_last_name, $this->person_first_name, $this->person_second_name]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDebts()
    {
        return $this->hasMany(Debt::className(), ['debt_person' => 'person_id']);
    }
}
