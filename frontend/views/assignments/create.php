<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Assignments */

$this->title = 'Create Assignments';
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
