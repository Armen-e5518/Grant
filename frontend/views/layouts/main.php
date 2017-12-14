<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
$class = Yii::$app->controller->action->id == 'login'
|| Yii::$app->controller->action->id == 'request-password-reset'
|| Yii::$app->controller->action->id == 'reset-password'
    ? 'login-page' : '';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">-->
    <!--    <link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />-->
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= $class ?>">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
