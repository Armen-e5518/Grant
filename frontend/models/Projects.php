<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "projects".
 *
 * @property integer $id
 * @property string $ifi_name
 * @property string $project_name
 * @property string $project_dec
 * @property string $tender_stage
 * @property string $request_issued
 * @property string $deadline
 * @property string $budget
 * @property string $duration
 * @property string $eligibility_restrictions
 * @property string $selection_method
 * @property string $submission_method
 * @property string $evaluation_decision_making
 * @property string $beneficiary_stakeholder
 * @property integer $status
 * @property integer $state
 * @property integer $status_important
 * @property string $create_de
 * @property string $update_de
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $attachments;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attachments'], 'file'],
            [['ifi_name'], 'required'],
            [['tender_stage'], 'string'],
            [['status', 'state', 'status_important'], 'integer'],
            [['create_de', 'update_de'], 'safe'],
            [['ifi_name', 'project_name', 'project_dec', 'request_issued', 'deadline', 'budget', 'duration', 'eligibility_restrictions', 'selection_method', 'submission_method', 'evaluation_decision_making', 'beneficiary_stakeholder'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ifi_name' => 'Ifi Name',
            'project_name' => 'Project Name',
            'project_dec' => 'Project Dec',
            'tender_stage' => 'Tender Stage',
            'request_issued' => 'Request Issued',
            'deadline' => 'Deadline',
            'budget' => 'Budget',
            'duration' => 'Duration',
            'eligibility_restrictions' => 'Eligibility Restrictions',
            'selection_method' => 'Selection Method',
            'submission_method' => 'Submission Method',
            'evaluation_decision_making' => 'Evaluation Decision Making',
            'beneficiary_stakeholder' => 'Beneficiary Stakeholder',
            'status' => 'Status',
            'state' => 'State',
            'create_de' => 'Create De',
            'update_de' => 'Update De',
            'status_important' => 'Importance',
        ];
    }


    public static function GetAllProjectsAllJoin()
    {
        return $rows = (new \yii\db\Query())
            ->select(
                [
                    'p.*',
                    'c.country_name',
                    'u.firstname',
                    'u.lastname',
                ])
            ->from('projects as p')
            ->leftJoin(ProjectCountries::tableName() . ' pc', 'pc.project_id = p.id')
            ->leftJoin(Countries::tableName() . ' c', 'c.id = pc.country_id')
            ->leftJoin(ProjectMembers::tableName() . ' pm', 'pm.project_id = pc.id')
            ->leftJoin(User::tableName() . ' u', 'u.id = pm.user_id')
            ->all();
    }

    public static function GetAllProjects()
    {
        return self::find()->asArray()->all();
    }


}
