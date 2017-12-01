<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rules_name".
 *
 * @property integer $id
 * @property integer $rule_id
 * @property string $name
 * @property string $rule_kay
 */
class RulesName extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rules_name';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rule_id'], 'integer'],
            [['name', 'rule_kay'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rule_id' => 'Rule ID',
            'name' => 'Name',
            'rule_kay' => 'Rule Kay',
        ];
    }

    /**
     * @return array
     */
    public static function GetRules()
    {
        return self::find()->select('name,id')->indexBy('id')->column();
    }
}
