<?php

/* @var $this yii\web\View */
/* @var $members
 * */
use  yii\helpers\Html;

$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css');
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
$this->registerJsFile('//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js');
$this->registerJsFile('/js/members/src.js');
$this->title = 'Members';
?>


<div class="container d-flex">
    <div class="left-slide w-100-perc">
        <div class="logo"><a href="/"><img src="/main/assets/images/logo-short.png" alt="" class="w-100-perc"></a></div>
        <ul class="left-slide-menu">
            <li><a href="/" class="d-block prospects  no-underline white-txt"><i class="fa fa-file-text-o"></i>Prospects</a>
            </li>
            <li><a href="/members" class="d-block active members no-underline white-txt"><i class="fa fa-users"></i>Members</a></li>
            <li><a href="#" class="d-block reports no-underline white-txt"><i class="fa fa-bar-chart"></i>Reports</a>
            </li>
            <li><a href="#" class="d-block countries no-underline white-txt"><i class="fa fa-globe"></i>Countries</a>
            </li>
        </ul>
        <a href="#" class="add-new-block no-underline white-txt"><i></i>Add new prospect</a>
    </div>
    <div class="wrapper">
        <div class="top-bar d-flex">
            <div class="search p-rel w-100-perc">
                <!--                <i class="fa fa-search p-abs"></i>-->
                <!--                <input type="text" placeholder="Search" class="font-w-300 brd-rad-4">-->
            </div>
            <div class="user d-flex">
                <div class="user-avatar brd-rad-4"><a href="#"><img src="/main/assets/images/members/member-1.png"
                                                                    alt="Member 1" title="Member 1"></a></div>
                <div class="user-name"><a href="#" class="font-14 no-underline">Ani Hakobyan<i
                                class="fa fa-angle-down"></i></a></div>
                <div class="user-settings"><a href="#" class="fa fa-cog no-underline"></a></div>
                <div class="user-menu"><a href="#" class="fa fa-bars no-underline"></a></div>
            </div>
        </div>
        <div class="main d-flex">
            <table id="memebers" style="width:100%">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?= $member['firstname'] ?></td>
                        <td><?= $member['lastname'] ?></td>
                        <td><?= $member['email'] ?></td>
                        <td>
                            <?= Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['/members/update', 'id' => $member['id']]) ?>
                            <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', ['/members/delete', 'id' => $member['id']]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
