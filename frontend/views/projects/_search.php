<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\search\ProjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ifi_name') ?>

    <?= $form->field($model, 'project_name') ?>

    <?= $form->field($model, 'project_dec') ?>

    <?= $form->field($model, 'tender_stage') ?>

    <?php // echo $form->field($model, 'request_issued') ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'budget') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'eligibility_restrictions') ?>

    <?php // echo $form->field($model, 'selection_method') ?>

    <?php // echo $form->field($model, 'submission_method') ?>

    <?php // echo $form->field($model, 'evaluation_decision_making') ?>

    <?php // echo $form->field($model, 'beneficiary_stakeholder') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'create_de') ?>

    <?php // echo $form->field($model, 'update_de') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
