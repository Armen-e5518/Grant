<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user_rules
/* @var $model
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

    <img width="100px" src="/uploads/<?= $model->image_url ?>" alt="">

    <div class="add-rules">
        <?= \kartik\select2\Select2::widget([
            'name' => 'rules',
            'value' => $user_rules,
            'data' => $rules,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a rules ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
//                        'maximumInputLength' => 10
            ],
        ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
