<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/23/17
 * Time: 4:33 PM
 */
?>
<div class="top-bar d-flex">
    <div class="search p-rel w-100-perc">
        <!--                <i class="fa fa-search p-abs"></i>-->
        <!--                <input type="text" placeholder="Search" class="font-w-300 brd-rad-4">-->
    </div>
    <div class="user d-flex">
        <div class="user-avatar brd-rad-4">
            <a href="#">
                <img src="<?= !empty(Yii::$app->user->identity->image_url) ? Yii::$app->params['user_url'] . Yii::$app->user->identity->image_url : '/images/no-user.png' ?>">
            </a>
        </div>
        <div class="user-name">
            <a href="#" class="font-14 no-underline" id="user-profile">
                <?= Yii::$app->user->identity->firstname . ' ' . Yii::$app->user->identity->lastname ?>
                <i class="fa fa-angle-down"></i>
            </a>
            <div class="user-down d-none padding-5 font-12 txt-center gray-bg">
                <a class="black-txt" href="/site/logout" data-method="post">Sign out</a>
            </div>
        </div>
        <!--        <div class="user-settings"><a href="#" class="fa fa-cog no-underline"></a></div>-->
        <!--        <div class="user-menu"><a href="#" class="fa fa-bars no-underline"></a></div>-->
    </div>
</div>
