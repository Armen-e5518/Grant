<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')])->label(false) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('lastname')])->label(false) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('firstname')])->label(false) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('password_hash')])->label(false) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')])->label(false) ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Yes', '0' => 'No'],[ 'prompt'=>'Select status'])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
