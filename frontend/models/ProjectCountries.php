<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "project_countries".
 *
 * @property integer $id
 * @property integer $country_id
 * @property integer $project_id
 */
class ProjectCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'project_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'project_id' => 'Project ID',
        ];
    }

    public static function SaveCountriesByProjectId($project_id = null, $countries = null)
    {
        $flag = true;
        self::deleteAll(['project_id' => $project_id]);
        if (!empty($project_id) && !empty($countries)) {
            foreach ($countries as $country) {
                $model = new self();
                $model->project_id = $project_id;
                $model->country_id = $country;
                if (!$model->save()) {
                    $flag = false;
                }
            }
        }
        return $flag;
    }

    public static function GetCountriesByProjectId($project_id = null)
    {
        if (!empty($project_id)) {
            return self::find()->select('country_id')->where(['project_id' => $project_id])->column();
        }
        return [];
    }

    public static function GetCountriesByProjectIdAllData($project_id = null)
    {
        if (!empty($project_id)) {
            return $rows = (new \yii\db\Query())
                ->select(
                    [
                        'c.*',
                    ])
                ->from('project_members as pm')
                ->leftJoin(Countries::tableName() . ' c', 'c.id = pc.country_id')
                ->where(['pm.project_id' => $project_id])
                ->all();
        }
        return [];
    }
}
