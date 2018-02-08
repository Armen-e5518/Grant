<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_countries".
 *
 * @property int $id
 * @property int $user_id
 * @property int $country_id
 */
class UserCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'country_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'country_id' => 'Country ID',
        ];
    }

    public static function SaveCountriesByUserId($user_id = null, $country_ids = null)
    {
        $flag = true;
        self::deleteAll(['user_id' => $user_id]);
        if (!empty($user_id) && !empty($country_ids)) {
            foreach ($country_ids as $country_id) {
                $model = new self();
                $model->country_id = $country_id;
                $model->user_id = $user_id;
                if (!$model->save()) {
                    $flag = false;
                }
            }
        }
        return $flag;
    }

    public static function GetCountriesByUserId($user_id = null)
    {
        if (!empty($user_id)) {
            return self::find()->select('country_id')->where(['user_id' => $user_id])->column();
        }
        return [];
    }

    public static function GetCountriesByUserIdByImplode()
    {
        $res = self::find()->select('country_id')->where(['user_id' => Yii::$app->user->getId()])->column();
        if (!empty($res)) {
            return implode(',', $res);
        }
        return 0;
    }

    public static function GetCountryNameByUserId($user_id = null)
    {
        if (!empty($user_id)) {
            return self::find()
                ->select('c.country_name')
                ->rightJoin(Countries::tableName() . ' c', 'c.id = ' . self::tableName() . '.country_id')
                ->where([self::tableName() . '.user_id' => $user_id])
                ->column();
        }
        return [];
    }
}
