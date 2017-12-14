<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "project_members".
 *
 * @property integer $id
 * @property integer $project_id
 * @property integer $user_id
 */
class ProjectMembers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id'], 'integer'],
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
        ];
    }

    /**
     * @param null $project_id
     * @param null $members
     * @return bool
     */
    public static function SaveMembersByProjectId($project_id = null, $members = null)
    {
        $flag = true;
        self::deleteAll(['project_id' => $project_id]);
        if (!empty($project_id) && !empty($members)) {
            foreach ($members as $member) {
                $model = new self();
                $model->project_id = $project_id;
                $model->user_id = $member;
                if (!$model->save()) {
                    $flag = false;
                }
            }
        }
        return $flag;
    }

    /**
     * @param null $post
     * @return bool
     */
    public static function SaveMemberByProjectId($post = null)
    {
        if (!empty($post['project_id']) && !empty($post['id'])) {
            $model = new self();
            $model->project_id = $post['project_id'];
            $model->user_id = $post['id'];
            return $model->save();
        }
        return false;
    }

    /**
     * @param null $project_id
     * @return array
     */
    public static function GetMembersByProjectId($project_id = null)
    {
        if (!empty($project_id)) {
            return self::find()->select('user_id')->where(['project_id' => $project_id])->column();
        }
        return [];
    }

    /**
     * @param null $project_id
     * @return array
     */
    public static function GetMembersByProjectIdAllData($project_id = null)
    {
        if (!empty($project_id)) {
            return (new \yii\db\Query())
                ->select(
                    [
                        'u.*',
                    ])
                ->from('project_members as pm')
                ->leftJoin(User::tableName() . ' u', 'u.id = pm.user_id')
                ->where(['pm.project_id' => $project_id])
                ->all();
        }
        return [];
    }

    public static function DeleteProjectMember($project_id = null, $user_id = null)
    {
        if (!empty($project_id) && !empty($user_id)) {
            return self::deleteAll(['project_id' => $project_id, 'user_id' => $user_id]);
        }
        return false;
    }

}
