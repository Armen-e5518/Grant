<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Companies */
$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->title = 'Create Company';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid d-flex my-content">

    <?= $this->render('/common/left-menu',['active' => 'companies']) ?>

    <div class="wrapper">

        <?= $this->render('/common/top-bar') ?>

        <div class="main m-members ">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
