<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Projects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ifi_name',
            'project_name',
            'project_dec',
            'tender_stage',
            // 'request_issued',
            // 'deadline',
            // 'budget',
            // 'duration',
            // 'eligibility_restrictions',
            // 'selection_method',
            // 'submission_method',
            // 'evaluation_decision_making',
            // 'beneficiary_stakeholder',
            // 'status',
            // 'state',
            // 'create_de',
            // 'update_de',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
