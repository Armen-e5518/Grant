<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_notifications".
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property int $type 0-comment , 1 - new project
 * @property int $status 1 -read , 0 - active
 * @property string $date
 */
class UserNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id', 'type', 'status'], 'integer'],
            [['date'], 'safe'],
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
            'type' => 'Type',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }

    /**
     * @param null $members
     * @param null $project_id
     * @param $type
     * @return bool
     */
    public static function NewNotificationsByUsers($members = null, $project_id = null, $type)
    {
        $flag = true;
        if (!empty($members) && !empty($project_id)) {
            $date = date("Y-m-d H:i:s");
            foreach ($members as $member) {
                $model = new self();
                $model->type = $type;
                $model->user_id = $member;
                $model->project_id = $project_id;
                $model->date = $date;
                if (!$model->save()) {
                    $flag = false;
                };
            }
        }
        return $flag;
    }

    /**
     * @return static[]
     *
     */
    public static function GetCurrentUserNotifications()
    {
        return self::find()
            ->where([
                'user_id' => Yii::$app->user->getId(),
                'status' => 0
            ])
            ->orderBy(['date' => SORT_DESC])
            ->asArray()
            ->all();
    }

    public static function ReadNotification($id)
    {
        if (!empty($id)) {
            $model = self::findOne(['id' => $id]);
            if (!empty($model)) {
                $model->status = 1;
                return $model->save();
            }
        }
        return false;
    }

    public static function AddNewNotificationInUser($user_id = null, $project_id = null, $type = 1)
    {
        if (!empty($user_id) && !empty($project_id) && $user_id != Yii::$app->user->getId()) {
            $model = new self();
            $model->type = $type;
            $model->user_id = $user_id;
            $model->project_id = $project_id;
            $model->date = date("Y-m-d H:i:s");;
            return $model->save();
        }
        return false;
    }
}
