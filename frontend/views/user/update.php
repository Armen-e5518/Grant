<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\User */
$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
$this->registerJsFile('/main/assets/js/custom.js');

$this->title = 'Update Member';

$this->params['breadcrumbs'][] = $this->title;


?>


<div class="container-fluid d-flex my-content">
    <?= $this->render('/common/left-menu',['active' => 'members']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members ">
            <i id="show-left-slide" class="fa fa-arrow-circle-left brd-rad-4"></i>
		<div class="filter-bar">
            		<span class="font-14 font-w-300 gray-txt"><?= Html::encode($this->title) ?></span>
		</div>

	            <div class="grid-view">
	                <?= $this->render('_form_u', [
	                    'model' => $model,
	                    'rules' => $rules,
	                    'user_rules' => $user_rules,
	                    'countries' => $countries,
//	                    'user_country' => $user_country,
	                    'companies' => $companies,
	                    'select_countries' => $select_countries,
	                ]) ?>
	            </div>
        </div>
    </div>
</div>
