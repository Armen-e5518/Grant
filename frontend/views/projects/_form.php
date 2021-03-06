<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;

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
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',]]); ?>
    <div class="col-md-6">
        <?= $form->field($model, 'ifi_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('ifi_name')])->label(false) ?>
        <?= $form->field($model, 'client_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('client_name')])->label(false) ?>
        <?= $form->field($model, 'name_firm')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('name_firm')])->label(false) ?>
        <?= $form->field($model, 'project_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('project_name')])->label(false) ?>
        <?= $form->field($model, 'project_dec')->textarea(['maxlength' => true, 'row' => 8, 'placeholder' => $model->getAttributeLabel('project_dec')])->label(false) ?>
        <lable>Tender stage</lable>
        <?= $form->field($model, 'tender_stage')->dropDownList(['Propasal' => 'Propasal', 'Eol' => 'Eol',], ['prompt' => ''])->label(false) ?>
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
                'format' => 'yyyy-mm-dd',
                'todayBtn' => true,
            ]
        ]);
        ?>
        <?= $form->field($model, 'budget')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('budget')])->label(false) ?>
        <?= $form->field($model, 'duration')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('duration')])->label(false) ?>
        <div class="add-countries">
            <?= \kartik\select2\Select2::widget([
                'name' => 'countries',
                'value' => $select_countries,
                'data' => $countries,
                'maintainOrder' => true,
                'options' => ['placeholder' => 'Countries ...', 'id' => 'add-country', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                ],
            ]);
            ?>
        </div>
        <?= $form->field($model, 'international_status')->checkbox([])->label(false); ?>
        <?php if (!empty($attachments)): ?>
            <div class="attachments">
                <?php foreach ($attachments as $attachment): ?>
                    <div class="attachment gray-bg padding-5 margin-btn-5">
                        <?php if ($attachment['type'] == 'png' || $attachment['type'] == 'jpg'): ?>
                            <div class="attachment-img">
                                <img src="<?= Yii::$app->params['attachments_url'] . $attachment['src'] ?>" alt="">
                            </div>
                        <?php endif; ?>
                        <a download
                           class="font-14"
                           href="<?= Yii::$app->params['attachments_url'] . $attachment['src'] ?>"><?= $attachment['src'] ?></a>
                        <i class="fa fa-trash-o delete-attachment" data-id="<?= $attachment['id'] ?>"
                           title="Delete attachment"
                           aria-hidden="true"></i>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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
        <?= $form->field($model, 'eligibility_restrictions')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('eligibility_restrictions')])->label(false) ?>
        <?= $form->field($model, 'selection_method')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('selection_method')])->label(false) ?>
        <?= $form->field($model, 'submission_method')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('submission_method')])->label(false) ?>
        <?= $form->field($model, 'evaluation_decision_making')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('evaluation_decision_making')])->label(false) ?>
        <?= $form->field($model, 'beneficiary_stakeholder')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('beneficiary_stakeholder')])->label(false) ?>
        <?= $form->field($model, 'status')->dropDownList($model::STATUS)->label(false); ?>
        <?= $form->field($model, 'importance_1')->checkbox([])->label(false); ?>
        <?= $form->field($model, 'importance_2')->checkbox([])->label(false); ?>
        <?= $form->field($model, 'importance_3')->checkbox()->label(false); ?>
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
    <div class="form-group col-md-12" style="margin-top: 20px">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
