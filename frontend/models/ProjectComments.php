<?php

namespace frontend\models;

use frontend\components\Helper;
use kartik\helpers\Html;
use Yii;

/**
 * This is the model class for table "project_comments".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 * @property string $comment
 * @property string $date
 * @property integer $status
 */
class ProjectComments extends \yii\db\ActiveRecord
{
    public $user_name;
    public $user_cut;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'project_id', 'status'], 'integer'],
            [['comment', 'date'], 'string'],
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
            'comment' => 'Comment',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }

    public static function SaveProjectComment($post = null)
    {
        if (!empty($post['project_id']) && !empty($post['text'])) {
            $date = date("Y-m-d H:i:s");
            $model = new  self();
            $model->project_id = $post['project_id'];
            $model->user_id = Yii::$app->user->identity->getId();
            $model->comment = Html::encode($post['text']);
            $model->date = date("Y-m-d H:i:s", strtotime('+10 hour', strtotime($date)));
            if ($model->save()) {

                $model['user_name'] = Helper::GetUserName();
                $model['user_cut'] = Helper::GetUserCharacters();

                return [
                    'model' => $model,
                    'user_name' => Helper::GetUserName(),
                    'user_cut' => Helper::GetUserCharacters(),
                ];
            };

        }
        return false;
    }

    public static function GetCommentsByProjectId($project_id = null)
    {
        if (!empty($project_id)) {
            return $rows = (new \yii\db\Query())
                ->select(
                    [
                        "CONCAT(`u`.`firstname`,' ',`u`.`lastname`) as user_name",
                        'CONCAT(SUBSTRING(u.firstname, 1, 1),SUBSTRING(u.lastname, 1, 1)) as user_cut',
                        'pc.*',
                    ])
                ->from('project_comments as pc')
                ->leftJoin(User::tableName() . ' u', 'u.id = pc.user_id')
                ->where(['pc.project_id' => $project_id])
                ->orderBy('`pc`.`id` DESC')
                ->all();
        }
        return [];
    }
}
