<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project_checklists".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $deadline
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class ProjectChecklists extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_checklists';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['deadline'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public static function SaveChecklistByProjectId($post = null)
    {
        if (!empty($post['project_id']) && !empty($post['title']) && !empty($post['deadline'])) {
            $model = new self();
            $model->project_id = $post['project_id'];
            $model->title = $post['title'];
            $model->user_id = Yii::$app->user->identity->getId();
            $model->description = $post['description'];
            $model->deadline = $post['deadline'];
            if ($model->save() && ChecklistUsers::SaveChecklistUser($model->id, $post['members'])) {
                return true;
            }
        }
        return false;
    }

    public static function GetChecklistsByProjectId($project_id = null)
    {
        if (!empty($project_id)) {
            return self::find()
                ->where(['project_id' => $project_id])
                ->orderBy(['deadline' => SORT_ASC])
                ->asArray()
                ->all();
        }
        return [];
    }

    public static function GetChecklistsIdsByProjectId($project_id = null)
    {
        if (!empty($project_id)) {
            return self::find()->select(['id'])->where(['project_id' => $project_id])->column();
        }
        return [];
    }

    public static function ChangeChecklistStatus($id)
    {
        if (!empty($id)) {
            $model = self::findOne(['id' => $id]);
            $model->status = $model->status == 1 ? 0 : 1;
            if ($model->save()) {
                return $model->status;
            }
        }
        return false;
    }

    public static function DeleteChecklistById($id = null)
    {
        if (!empty($id)) {
            return self::deleteAll(['id' => $id]);
        }
        return false;
    }

}
