<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "project_favorite".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 */
class ProjectFavorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_favorite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id'], 'integer'],
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
            'project_id' => 'Project ID',
        ];
    }

    public static function SaveOrDeleteFavorite($id)
    {
        if (!empty($id)) {
            $user_id = Yii::$app->user->identity->getId();
            $model = self::findOne(['project_id' => $id, 'user_id' => $user_id]);
            if (empty($model)) {
                $m = new self();
                $m->user_id = Yii::$app->user->identity->getId();
                $m->project_id = $id;
                if ($m->save()) {
                    return 'save';
                };
            } else {
                if ($model->delete()) {
                    return 'delete';
                };
            }
        }
        return 'not-id';
    }

    public static function GetFavoritesByUserId()
    {
        return self::find()
            ->select('project_id')
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->column();
    }
}
