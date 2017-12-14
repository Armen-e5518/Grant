
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile('/main/assets/css/login.css');

$this->title = 'Password reset';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
    <div class="logo">
        <a href="/">
            <img src="/main/assets/images/logo.png"
                 alt="Grant Thornton | An instinct for growth&trade;"
                 title="Grant Thornton | An instinct for growth&trade;">
        </a>
    </div>
    <div class="access-area">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="access-form">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <div class="welcome-heading">Request password reset</div>
            <div class="login-component">
                <label class="username">
                    <?= $form->field($model, 'email')->textInput([
                        'autofocus' => true,
                        'placeholder' => 'Email'
                    ])->label(false) ?>
                </label>
            </div>
            <div class="login-component">
                <button>sign-in</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

