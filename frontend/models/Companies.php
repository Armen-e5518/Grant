<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property integer $id
 * @property string $name
 * @property integer $country
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'country' => 'Country',
        ];
    }

    /**
     * @return array
     */
    public static function GetCompanies()
    {
        return self::find()->select(["name", 'id'])->indexBy('id')->column();
    }

    /**
     * @param $id
     * @return static
     */
    public static function GetCompanyNameById($id)
    {
        return self::findOne(['id' => $id]);
    }
}
