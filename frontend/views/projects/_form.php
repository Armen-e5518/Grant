<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;
use kartik\checkbox\CheckboxX;

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

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

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

        <?php if (!empty($attachments)): ?>
            <div class="attachments">
                <?php foreach ($attachments as $attachment): ?>
                    <div class="attachment">
                        <?php if ($attachment['type'] == 'png' || $attachment['type'] == 'jpg'): ?>
                            <div class="attachment-img">
                                <img src="<?= Yii::$app->params['attachments_url'] . $attachment['src'] ?>" alt="">
                            </div>
                        <?php endif; ?>
                        <a download
                           href="<?= Yii::$app->params['attachments_url'] . $attachment['src'] ?>"><?= $attachment['src'] ?></a>
                        <i class="fa fa-trash-o delete-attachment" data-id="<?= $attachment['id'] ?>"
                           aria-hidden="true"></i>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <leble>Add Attachments</leble>

        <?= FileInput::widget([
            'model' => $model,
            'name' => 'attachments[]',
            'attribute' => 'attachments[]',
            'options' => [
                'multiple' => true,
            ],
            'pluginOptions' => [
                'showUpload' => false,
            ]
        ]);
        ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'eligibility_restrictions')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'selection_method')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'submission_method')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'evaluation_decision_making')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'beneficiary_stakeholder')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(['0' => 'In progress', '1' => 'Applied']); ?>

        <?= $form->field($model, 'pending_approval')->checkbox([]); ?>

        <?= $form->field($model, 'submitted')->checkbox(); ?>

        <?= $form->field($model, 'submission_process')->checkbox([]); ?>


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
