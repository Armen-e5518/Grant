<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Projects;

/**
 * ProjectsSearch represents the model behind the search form about `frontend\models\Projects`.
 */
class ProjectsSearch extends Projects
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'state','status_important'], 'integer'],
            [['ifi_name', 'project_name', 'project_dec', 'tender_stage', 'request_issued', 'deadline', 'budget', 'duration', 'eligibility_restrictions', 'selection_method', 'submission_method', 'evaluation_decision_making', 'beneficiary_stakeholder', 'create_de', 'update_de'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Projects::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'state' => $this->state,
            'create_de' => $this->create_de,
            'update_de' => $this->update_de,
        ]);

        $query->andFilterWhere(['like', 'ifi_name', $this->ifi_name])
            ->andFilterWhere(['like', 'project_name', $this->project_name])
            ->andFilterWhere(['like', 'project_dec', $this->project_dec])
            ->andFilterWhere(['like', 'tender_stage', $this->tender_stage])
            ->andFilterWhere(['like', 'request_issued', $this->request_issued])
            ->andFilterWhere(['like', 'deadline', $this->deadline])
            ->andFilterWhere(['like', 'budget', $this->budget])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'eligibility_restrictions', $this->eligibility_restrictions])
            ->andFilterWhere(['like', 'selection_method', $this->selection_method])
            ->andFilterWhere(['like', 'submission_method', $this->submission_method])
            ->andFilterWhere(['like', 'evaluation_decision_making', $this->evaluation_decision_making])
            ->andFilterWhere(['like', 'beneficiary_stakeholder', $this->beneficiary_stakeholder]);

        return $dataProvider;
    }
}
