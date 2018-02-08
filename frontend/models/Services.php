<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Services".
 *
 * @property integer $id
 * @property string $name
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Services';
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
    public static function GetServices()
    {
        return self::find()->select(["name", 'id'])->indexBy('id')->column();
    }

    public static function GetServiceById($id)
    {
        return self::findOne(['id' => $id]);
    }
}
