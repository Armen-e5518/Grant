<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Companies */

$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
$this->registerJsFile('/main/assets/js/custom.js');

$this->title = $model->name;

?>
<div class="container-fluide my-content d-flex">
    <?= $this->render('/common/left-menu', ['active' => 'companies']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members ">
            <i id="show-left-slide" class="fa fa-arrow-circle-left brd-rad-4"></i>
		<div class="filter-bar">
			<span class="font-14 font-w-300 gray-txt"><?= Html::encode($this->title) ?></span>
		</div>
		<div class="grid-view">
		    <p align="center">
		        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
		            'class' => 'btn btn-danger',
		            'data' => [
		                'confirm' => 'Are you sure you want to delete this item?',
		                'method' => 'post',
		            ],
		        ]) ?>
		    </p>
			<br>
		    <?= DetailView::widget([
		        'model' => $model,
		        'attributes' => [
		            'id',
		            'name',
		//            'country',
		        ],
		    ]) ?>
		</div>
</div>
