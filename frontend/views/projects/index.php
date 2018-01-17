<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');

$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
$this->registerJsFile('/main/assets/js/custom.js');

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\ProjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid d-flex my-content">
    <?= $this->render('/common/left-menu', ['active' => 'reports']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members">
            <i id="show-left-slide" class="fa fa-arrow-circle-left brd-rad-4"></i>
            <div class="filter-bar d-flex">
                <span class="font-14 font-w-300 gray-txt"><?= Html::encode($this->title) ?></span>
            </div>
            <div>

                <?php
                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'ifi_name',
                    'project_name',
                    'tender_stage',
                    'deadline',
                    ['class' => 'yii\grid\ActionColumn'],
                ];

                // Renders a export dropdown menu
//                echo ExportMenu::widget([
//                    'dataProvider' => $dataProvider,
//                    'columns' => $gridColumns
//                ]);

                // You can choose to render your own GridView separately
                echo \kartik\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns
                ]);
                ?>


            </div>
        </div>
    </div>
</div>

