<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
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
 * @property integer $submitted
 * @property string $create_de
 * @property string $update_de
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $attachments;

    const STATUS_ARCHIVE = 2;

    const STATUS_ACTIVE = 1;

    const STATUS_DELETE = 0;

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
            [['ifi_name', 'project_name', 'deadline', 'request_issued'], 'required'],
            [['tender_stage'], 'string'],
            [['status', 'state', 'pending_approval', 'submitted', 'submission_process', 'international_status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'pending_approval' => 'Pending approval',
            'submitted' => 'Submitted',
            'submission_process' => 'Submission process',
            'international_status' => 'International / open for non residents',
        ];
    }

    /**
     * @return array
     */
    public static function GetAllProjectsAllJoin()
    {
        return (new \yii\db\Query())
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

    /**
     * @param null $params
     * @return array
     */
    public static function GetAllProjects($params = null)
    {

        $query = (new \yii\db\Query())
            ->select(
                [
                    'p.*',
                ])
            ->from('projects as p');

        if (!empty($params['a'])) {
            $query->andWhere(['p.state' => self::STATUS_ARCHIVE]);
        } else {
            $query->andWhere(['p.state' => self::STATUS_ACTIVE]);
        }
        if (!empty($params['f'])) {
            $query->rightJoin(ProjectFavorite::tableName() . ' f', 'f.project_id = p.id AND f.user_id = ' . Yii::$app->user->identity->getId());
        }
        return $query
            ->orderBy(['p.deadline' => SORT_DESC])
            ->all();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function ChangeStatusToArchive($id)
    {
        $model = self::findOne(['id' => $id]);
        if (!empty($model)) {
            $model->state = self::STATUS_ARCHIVE;
            return $model->save();
        }
        return false;
    }

    public static function GetProjectDataById($id)
    {
        return self::findOne(['id' => $id]);
    }
}
