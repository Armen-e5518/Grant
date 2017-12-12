<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="countries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('country_code')])->label(false) ?>

    <?= $form->field($model, 'country_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('country_name')])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
