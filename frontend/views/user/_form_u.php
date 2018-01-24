<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user_rules
/* @var $select_countries
 * /* @var $countries
 * /* @var $model
 * /* @var $model frontend\models\User
 */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('firstname')])->label(false) ?>
    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('lastname')])->label(false) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
    <?= $form->field($model, 'status')->dropDownList(['10' => 'Yes', '0' => 'No'])->label(false); ?>
    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?php if (!empty($model->image_url)): ?>
        <p>
            <img width="100px" src="/uploads/<?= $model->image_url ?>" alt="">
        </p>
    <?php endif; ?>
    <br>
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
    <!--    <div class="add-country">-->
    <!--        --><? //= \kartik\select2\Select2::widget([
    //            'name' => 'country_id',
    //            'attribute' => 'country_id',
    //            'model' => $model,
    //            'data' => $countries,
    //            'maintainOrder' => true,
    //            'options' => [
    //                'placeholder' => 'Select a country...',
    //            ],
    //            'pluginOptions' => [
    //                'tags' => true,
    //            ],
    //        ]);
    //        ?>
    <!--    </div>-->
    <br>
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
    <br>
    <div class="add-rules">
        <?= \kartik\select2\Select2::widget([
            'name' => 'rules',
            'value' => $user_rules,
            'data' => $rules,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Select a rules...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]);
        ?>
    </div>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
