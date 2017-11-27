<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Projects */

$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->title = 'Update Project: ' . $model->ifi_name;

?>
<div class="container-fluid d-flex my-content">
    <?= $this->render('/common/left-menu',['active' => 'prospects']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members ">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="access-form">
                <?= $this->render('_form', [
                    'model' => $model,
                    'members' => $members,
                    'select_members' => $select_members,
                    'countries' => $countries,
                    'select_countries' => $select_countries,
                ]) ?>
            </div>
        </div>
    </div>
</div>
