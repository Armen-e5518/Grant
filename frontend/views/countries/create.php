<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Countries */
$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
$this->registerJsFile('/main/assets/js/custom.js');

$this->title = 'Create Country';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluid d-flex my-content">
    <?= $this->render('/common/left-menu',['active' => 'country']) ?>
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
			]) ?>
		
		</div>
        </div>
    </div>
</div>
