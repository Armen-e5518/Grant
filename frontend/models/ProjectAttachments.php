<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "project_attachments".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $src
 * @property string $type
 */
class ProjectAttachments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_attachments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'integer'],
            [['src'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 10],
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
            'src' => 'Src',
            'type' => 'Type',
        ];
    }

    /**
     * @param null $project_id
     * @param null $src
     * @param null $type
     * @return bool
     */
    public static function SaveAttachment($project_id = null, $src = null, $type = null)
    {
        if (!empty($project_id) && !empty($src)) {
            $model = new self();
            $model->project_id = $project_id;
            $model->src = $src;
            $model->type = $type;
            return $model->save();
        }
        return false;
    }

    /**
     * @param $project_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function GetAttachmentsByProjectId($project_id)
    {
        if (!empty($project_id)) {
            return self::find()->where(['project_id' => $project_id])->asArray()->all();
        }
        return [];
    }

    /**
     * @param null $id
     * @return bool|int
     */
    public static function DeleteAttachmentById($id = null)
    {
        $model = self::findOne(['id'=> $id]);
        if(!empty($model['src'])){
            unlink(Yii::getAlias('@frontend') . '/web/attachments/'. $model['src']);
            return self::deleteAll(['id' => $id]);
        }
        return false;
    }
}
