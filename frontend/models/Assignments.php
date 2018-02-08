<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "assignments".
 *
 * @property integer $id
 * @property string $name
 */
class Assignments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assignments';
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
    public static function GetAssignments()
    {
        return self::find()->select(["name", 'id'])->indexBy('id')->column();
    }


    /**
     * @param $id
     * @return static
     */
    public static function GetAssignmentById($id)
    {
        return self::findOne(['id' => $id]);
    }
}
