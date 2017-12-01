<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user_rules
/* @var $countries
 * /* @var $model
 * /* @var $model frontend\models\User
 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'Yes', '0' => 'No']); ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <p>
        <img width="100px" src="/uploads/<?= $model->image_url ?>" alt="">
    </p>

    <lable>Select a country</lable>

    <div class="add-country">
        <?= \kartik\select2\Select2::widget([
            'name' => 'country_id',
            'attribute' => 'country_id',
            'model' => $model,
            'data' => $countries,
            'maintainOrder' => true,
            'options' => [
                'placeholder' => 'Select a country...',
            ],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>
    </div>

    <lable>Select a companies</lable>

    <div class="add-companies">
        <?= \kartik\select2\Select2::widget([
            'name' => 'company_id',
            'attribute' => 'company_id',
            'model' => $model,
            'data' => $companies,
            'maintainOrder' => true,
            'options' => [
                'placeholder' => 'Select a company...',
            ],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>
    </div>
    <lable>Select a rules</lable>

    <div class="add-rules">
        <?= \kartik\select2\Select2::widget([
            'name' => 'rules',
            'value' => $user_rules,
            'data' => $rules,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a rules ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
