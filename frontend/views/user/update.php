<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\User */
$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->title = 'Update Member';

$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluid d-flex my-content">
    <?= $this->render('/common/left-menu',['active' => 'members']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members ">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="access-form">
                <?= $this->render('_form_u', [
                    'model' => $model,
                    'rules' => $rules,
                    'user_rules' => $user_rules,
                    'countries' => $countries,
                    'user_country' => $user_country,
                ]) ?>
            </div>
        </div>
    </div>
</div>
