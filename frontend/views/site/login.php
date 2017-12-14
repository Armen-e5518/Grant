<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile('/main/assets/css/login.css');

$this->title = 'Grant Thornton | An instinct for growth&trade;';
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
        <h1>Pipeline Management System</h1>
        <div class="access-form">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="welcome-heading">Sign-in to access your account</div>
            <div class="login-component">
                <label class="username">
                    <?= $form->field($model, 'username')->textInput([
                        'autofocus' => true,
                        'placeholder' => 'Username / Email'
                    ])->label(false) ?>
                </label>
            </div>
            <div class="login-component">
                <label class="password">
                    <?= $form->field($model, 'password')->passwordInput([
                        'placeholder' => 'Password'
                    ])->label(false) ?>
                </label>
            </div>
            <div class="login-component">
                <label>
                    <span class="remember-me"><input type="checkbox">remember me</span>
                    <a href="/site/request-password-reset">
                        <i class="fa fa-angle-right"></i>forgot password
                    </a>
                </label>
            </div>
            <div class="login-component">
                <button>sign-in</button>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

