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

Yii::$app->formatter->nullDisplay = '';
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
                $gridColumnsMenu = [
                    [
                        'attribute' => '#',
                        'content' => function ($model, $key, $index, $column) {
                            return (int)($index + 1);
                        }
                    ],
                    'name_firm',         //Firm name
                    'client_name',
                    'ifi_name',
                    'project_name',
                    'location_within_country',
                    ['attribute' => 'status',
                        'value' => function ($model) {
                            return $model->GetStatus($model->status);
                        }
                    ],
                    'budget',
                    ['attribute' => 'industry_id',
                        'value' => function ($model) {
                            return $model->GetIndustryById($model->industry_id);
                        }
                    ],
                    ['attribute' => 'service_id',
                        'value' => function ($model) {
                            return $model->GetServiceById($model->service_id);
                        }
                    ],
                    'project_value',
                    'consultants',
                    'lead_partner',
                    'partner_contact',

                ];

                $gridColumns = [
                    [
                        'attribute' => '#',
                        'content' => function ($model, $key, $index, $column) {
                            return (int)($index + 1);
                        }
                    ],
                    'name_firm',         //Firm name
                    'client_name',
                    'ifi_name',
                    'project_name',
                    'location_within_country',
                    ['attribute' => 'status',
                        'value' => function ($model) {
                            return $model->GetStatus($model->status);
                        }
                    ],
                    'budget',
                    ['attribute' => 'industry_id',
                        'value' => function ($model) {
                            return $model->GetIndustryById($model->industry_id);
                        }
                    ],
                    ['attribute' => 'service_id',
                        'value' => function ($model) {
                            return $model->GetServiceById($model->service_id);
                        }
                    ],
                    'project_value',
                    'consultants',
                    'lead_partner',
                    'partner_contact',
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
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumnsMenu,
                    'target' => ExportMenu::TARGET_SELF,
                    'exportConfig' =>
                        [
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_PDF => false,
                        ]

                ]);
                echo \kartik\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
//                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

