<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Industrys".
 *
 * @property integer $id
 * @property string $name
 */
class Industrys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Industrys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * @return array
     */
    public static function GetIndustrys()
    {
        return self::find()->select(["name", 'id'])->indexBy('id')->column();
    }

    public static function GetIndustryById($id)
    {
        return self::findOne(['id' => $id]);
    }
}
