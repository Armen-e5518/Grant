<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

//use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\Projects */
/* @var $members */
/* @var $select_members */
/* @var $select_countries */
/* @var $countries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form row">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'ifi_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'project_dec')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tender_stage')->dropDownList(['Propasal' => 'Propasal', 'Eol' => 'Eol',], ['prompt' => '']) ?>

        <p>Valid Dates</p>
        <?= DatePicker::widget([
            'model' => $model,
            'name' => 'request_issued',
            'attribute' => 'request_issued',
            'type' => DatePicker::TYPE_RANGE,
            'name2' => 'deadline',
            'attribute2' => 'deadline',
            'options' => ['placeholder' => 'Request Issued'],
            'options2' => ['placeholder' => 'Deadline'],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-M-yyyy',
                'todayBtn' => true,
            ]
        ]);
        ?>

        <?= $form->field($model, 'budget')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>

        <div class="add-members">
            <leble>Select Countries</leble>
            <?= \kartik\select2\Select2::widget([
                'name' => 'countries',
                'value' => $select_countries,
                'data' => $countries,
                'maintainOrder' => true,
                'options' => ['placeholder' => 'Countries ...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                ],
            ]);
            ?>
        </div>

    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'eligibility_restrictions')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'selection_method')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'submission_method')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'evaluation_decision_making')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'beneficiary_stakeholder')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(['0' => 'In progress', '1' => 'Applied']); ?>

        <lable>Select a Members</lable>

        <div class="add-members">
            <?= \kartik\select2\Select2::widget([
                'name' => 'members',
                'value' => $select_members,
                'data' => $members,
                'maintainOrder' => true,
                'options' => ['placeholder' => 'Members ...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                ],
            ]);
            ?>
        </div>

    </div>

    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
