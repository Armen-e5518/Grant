<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Industrys */

$this->title = 'Create Industrys';
$this->params['breadcrumbs'][] = ['label' => 'Industrys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="industrys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
