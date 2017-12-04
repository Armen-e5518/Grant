<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $members
 * */

$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');
//$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
//$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
//$this->registerJsFile('//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js');
//$this->registerJsFile('/js/members/src.js');

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluid d-flex my-content">
    <?= $this->render('/common/left-menu', ['active' => 'members']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members">
		<div class="filter-bar">
			<span class="font-14 font-w-300 gray-txt"><?= Html::encode($this->title) ?></span>
		</div>
            <p>
                <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>
            <div>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                        'id',
                        'username',
                        'lastname',
                        'firstname',
//                    'auth_key',
                        // 'password_hash',
                        // 'password_reset_token',
                        'email:email',
                        [
                            'attribute' => 'Rules',
                            'format' => 'html',
                            'value' => function ($data) {
                                $s = '<ul>';
                                $user_rules = \frontend\models\UserRules::GetUserRulesNamesByUserId($data->id);
                                foreach ($user_rules as $r) {
                                    $s .= '<li>' . $r . '</li>';
                                }
                                $s .= '</ul>';
                                return $s;
                            },
                        ],
//                        'status',
                        [
                            'attribute' => 'image_url',
                            'format' => 'html',
                            'value' => function ($data) {
                                return Html::img('/uploads/' . $data->image_url,
                                    ['width' => '50px']);
                            },
                        ],
                        [
                            'attribute' => 'Active',
//                'format' => 'html',
                            'value' => function ($data) {
                                return ($data->status == 10) ? "Yes" : "No";
                            },
                        ],
                        // 'created_at',
                        // 'updated_at',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Actions',
                            'headerOptions' => ['style' => 'color:#337ab7'],
                            'template' => '{view}{update}{delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-eye" aria-hidden="true"></i>', $url, [
                                        'title' => Yii::t('app', 'lead-view'),
                                    ]);
                                },

                                'update' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>', $url, [
                                        'title' => Yii::t('app', 'lead-update'),
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', $url, [
                                        'title' => Yii::t('app', 'Delete'),
                                        'aria-label' => 'Delete',
                                        'data-pjax' => '0',
                                        'data-confirm' => 'Are you sure you want to delete this item?',
                                        'data-method' => 'post',
                                    ]);
                                }
//                        <a href="/user/delete?id=1" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
//
                            ],
//                            'urlCreator' => function ($action, $model, $key, $index) {
//                                if ($action === 'view') {
//                                    $url = '/user/view?id=' . $model->id;
//                                    return $url;
//                                }
//
//                                if ($action === 'update') {
//                                    $url = '/user/update?id=' . $model->id;
//                                    return $url;
//                                }
//                                if ($action === 'delete') {
//                                    $url = '/user/delete?id=' . $model->id;
//                                    return $url;
//                                }
//
//                            }
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
