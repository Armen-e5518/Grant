<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Projects */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ifi_name',
            'project_name',
            'project_dec',
            'tender_stage',
            'request_issued',
            'deadline',
            'budget',
            'duration',
            'eligibility_restrictions',
            'selection_method',
            'submission_method',
            'evaluation_decision_making',
            'beneficiary_stakeholder',
            'status',
            'state',
            'create_de',
            'update_de',
        ],
    ]) ?>

</div>
