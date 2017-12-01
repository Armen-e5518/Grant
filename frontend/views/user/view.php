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

$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluide my-content d-flex">
    <?= $this->render('/common/left-menu', ['active' => 'members']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main m-members ">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <div class="access-form">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
//                        'id',
                        [
                            'attribute' => 'image_url',
                            'value' => '/uploads/' . $model->image_url,
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
            </div>
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

