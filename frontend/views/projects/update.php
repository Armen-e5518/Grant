<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Projects */
/* @var $members */
/* @var $countries */
/* @var $select_members */
/* @var $attachments */
/* @var $select_countries */

$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
//$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
$this->registerJsFile('/main/assets/js/custom.js');
$this->registerJsFile('/js/Project/attachments.js');
$this->registerJsFile('/js/Project/create-project.js');
$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->title = 'Update Project: ' . $model->ifi_name;

?>
<div class="container-fluid d-flex my-content">
    <?= $this->render('/common/left-menu', ['active' => 'prospects']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members ">
            <i id="show-left-slide" class="fa fa-arrow-circle-left brd-rad-4"></i>
            <div class="filter-bar">
                <span class="font-14 font-w-300 gray-txt"><?= Html::encode($this->title) ?></span>
            </div>
            <div class="access-form">
                <?= $this->render('_form', [
                    'model' => $model,
                    'members' => $members,
                    'select_members' => $select_members,
                    'countries' => $countries,
                    'select_countries' => $select_countries,
                    'attachments' => $attachments,
                ]) ?>
            </div>
        </div>
    </div>
</div>
