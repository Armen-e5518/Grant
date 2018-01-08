<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $user_rules */
/* @var $model frontend\models\User */
$this->registerCssFile('/css/src.css');
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');
$this->title = $model->firstname . ' ' . $model->lastname;

$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
$this->registerJsFile('/main/assets/js/custom.js');

$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluide my-content d-flex">
    <?= $this->render('/common/left-menu', ['active' => 'members']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members">
            <i id="show-left-slide" class="fa fa-arrow-circle-left brd-rad-4"></i>
            <div class="filter-bar">
                <span class="font-14 font-w-300 gray-txt"><?= Html::encode($this->title) ?></span>
            </div>
            <div class="access-form">
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
//                        'id',
                        [
                            'attribute' => 'image_url',
                            'value' => function ($model) {
                                $img = !empty($model->image_url) ? $model->image_url : 'no-user.png';
                                return '/uploads/' . $img;
                            },
                            'format' => ['image', ['width' => '100']]
                        ],
                        'username',
                        'firstname',
                        'lastname',

//                        'auth_key',
//                        'password_hash',
//                        'password_reset_token',
                        'email:email',
                        [
                            'label' => 'Company',
                            'value' => function ($model) {
                                return $model->GetCompany($model->company_id);
                            }
                        ],
                        [
                            'label' => 'Country',
                            'value' => function ($model) {
                                return $model->GetCountry($model->country_id);
                            }
                        ],
//                        'company.name',
//                        'status',
                        [
                            'label' => 'Active',
                            'value' => function ($model) {
                                return ($model->status == 10) ? "Yes" : 'No';
                            }
                        ],
//                        'created_at',
//                        'updated_at',
                    ],
                ]) ?>

                <h1>Rules</h1>
                <div class="rules">
                    <ul>
                        <?php foreach ($user_rules as $rule): ?>
                            <li><?= $rule ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

