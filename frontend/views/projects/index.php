<?php

use yii\helpers\Html;
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
//                    ['class' => 'yii\grid\SerialColumn'],
//                    'id',
                    'ifi_name',
                    'project_name',
                    'project_dec',
                    'request_issued',
                    'tender_stage',
                    'deadline',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'headerOptions' => ['style' => 'color:#337ab7'],
                        'template' => '{view}{update}{delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="fa fa-file-word-o"></span>', $url, [
                                    'title' => Yii::t('app', 'Download word'),
                                ]);
                            },

                            'update' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                                ]);
                            }

                        ],
                    ],
                ];
                //Renders a export dropdown menu
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'target' => ExportMenu::TARGET_SELF,
                ]);

                // You can choose to render your own GridView separately
                echo \kartik\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

