<?php

namespace frontend\models;

use kartik\helpers\Html;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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

    const STATUS = [
        0 => "Pending approval",
        1 => "In progress",
        2 => "Submitted",
        3 => "Accepted",
        4 => "Dismiss",
        5 => "Rejected",
    ];

    const IMPORTANT = [
        0 => "Important 1",
        1 => "Important 2",
        2 => "Important 3",

    ];

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
            [['tender_stage', 'project_dec'], 'string'],
            [['status', 'state', 'importance_1', 'importance_2', 'importance_3', 'international_status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['ifi_name', 'project_name', 'request_issued', 'deadline', 'budget', 'duration', 'eligibility_restrictions', 'selection_method', 'submission_method', 'evaluation_decision_making', 'beneficiary_stakeholder'], 'string', 'max' => 255],
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
            'importance_1' => 'Important',
            'importance_2' => 'Most important',
            'importance_3' => 'More important',
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
            ->from('projects as p')
            ->leftJoin(ProjectCountries::tableName() . ' pce', 'pce.project_id = p.id AND pce.country_id = ' . Yii::$app->user->identity->country_id)
            ->leftJoin(ProjectMembers::tableName() . ' pme', 'pme.project_id = p.id AND pme.user_id = ' . Yii::$app->user->identity->getId())
            ->andFilterWhere(['OR',
//                ['pme.id IS not null'],
//                ['not', ['pme.id' => null]],
                ['IS NOT', 'pme.id', (new Expression('Null'))],
                ['IS NOT', 'pce.id', (new Expression('Null'))],
//                ['not', ['pce.id' => null]],
//                ['pce.id IS not null'],
//                ['is not', 'pce.id', null]
            ]);
//        WHERE pm.id IS not null or pc.id  is not null
        if (!empty($params['a'])) {
            $query->andWhere(['p.state' => self::STATUS_ARCHIVE]);
        } else {
            $query->andWhere(['p.state' => self::STATUS_ACTIVE]);
        }
        if (!empty($params['f'])) {
            $query->rightJoin(ProjectFavorite::tableName() . ' f', 'f.project_id = p.id AND f.user_id = ' . Yii::$app->user->identity->getId());
        }
        if (
            !empty($params['pending_approval'])
            || !empty($params['in_progress'])
            || !empty($params['submitted'])
            || !empty($params['accepted'])
            || !empty($params['rejected'])
            || !empty($params['closed'])
        ) {
            $q = ['OR'];
            if (!empty($params['pending_approval'])) {
                array_push($q, ['p.status' => 0]);
            }
            if (!empty($params['in_progress'])) {
                array_push($q, ['p.status' => 1]);
            }
            if (!empty($params['submitted'])) {
                array_push($q, ['p.status' => 2]);
            }
            if (!empty($params['accepted'])) {
                array_push($q, ['p.status' => 3]);
            }
            if (!empty($params['rejected'])) {
                array_push($q, ['p.status' => 4]);
            }
            if (!empty($params['closed'])) {
                array_push($q, ['p.status' => 5]);
            }
            $query->andFilterWhere($q);
        }
        if (!empty($params['country'])) {
            $query->andWhere(['pce.country_id' => $params['country']]);
        }
        if (!empty($params['deadline_from']) && !empty($params['deadline_to'])) {
            $query->andWhere(['between', 'p.deadline', $params['deadline_from'], $params['deadline_to']]);
        } else {
            if (!empty($params['deadline_from'])) {
                $query->andWhere(['>', 'p.deadline', $params['deadline_from']]);
            }
            if (!empty($params['deadline_to'])) {
                $query->andWhere(['<', 'p.deadline', $params['deadline_to']]);
            }
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

    /**
     * @param $id
     * @return static
     */
    public static function GetProjectDataById($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * @param $post
     * @return bool
     */
    public static function SaveProjectTitle($post)
    {
        if (!empty($post['project_id'])) {
            $model = self::findOne(['id' => $post['project_id']]);
            $model->ifi_name = Html::encode($post['text']);
            return $model->save();
        }
        return false;
    }

    /**
     * @param $post
     * @return bool
     */
    public static function SaveProjectDescription($post = null)
    {
        if (!empty($post['project_id'])) {
            $model = self::findOne(['id' => $post['project_id']]);
            $model->project_dec = Html::encode($post['text']);
            return $model->save();
        }
        return false;
    }

    /**
     * @param $post
     * @return bool
     */
    public static function ChangeProjectStatus($post = null)
    {
        if (!empty($post['project_id']) && !empty($post['status'])) {
            $model = self::findOne(['id' => $post['project_id']]);
            $model->status = (int)$post['status'];
            return $model->save();
        }
        return false;
    }

    /**
     * @param null $kay
     * @return mixed
     */
    public function GetSatusTitelByKay($kay = null)
    {
        return self::STATUS[$kay];
    }

    /**
     * @param null $kay
     * @return string
     */
    public function GetProductState($kay = null)
    {
//        if($kay == 0){
//            return 'Deleted';
//        }
        if ($kay == 1) {
            return 'Active';
        }
        if ($kay == 2) {
            return 'Archive';
        }
        return '';
    }
}
