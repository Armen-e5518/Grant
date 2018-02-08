<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "checklist_users".
 *
 * @property integer $id
 * @property integer $checklist_id
 * @property integer $user_id
 */
class ChecklistUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checklist_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['checklist_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'checklist_id' => 'Checklist ID',
            'user_id' => 'User ID',
        ];
    }

    public static function SaveChecklistUser($checklist_id = null, $user_ids = null)
    {
        $f = true;
        if (!empty($user_ids) && !empty($checklist_id)) {
            foreach ($user_ids as $id) {
                $model = new self();
                $model->checklist_id = $checklist_id;
                $model->user_id = $id;
                if (!$model->save()) {
                    $f = false;
                };
            }
        }
        return $f;
    }

    public static function GetUsersByChecklistIds($ids = null)
    {
        return self::find()
            ->select('u.*')
            ->leftJoin(User::tableName().' u','u.id = checklist_users.user_id')
            ->where(['checklist_id' => $ids])
            ->asArray()
            ->all();
    }


}
