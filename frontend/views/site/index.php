<?php
use yii\helpers\Html;
use frontend\components\Helper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $favorites */

$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js');
$this->registerJsFile('/js/Project/favorite.js');


$this->registerCssFile('/main/assets/css/style.css');
$this->title = 'Grant Thornton';
?>


<div class="container d-flex">
    <?= $this->render('/common/left-menu', ['active' => 'prospects']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main d-flex">
            <div>
                <div class="filter-bar d-flex">
                    <i id="show-left-slide" class="fa fa-arrow-circle-left brd-rad-4"></i>
                    <i id="show-right-slide" class="fa fa-arrow-circle-right brd-rad-4"></i>
                    <div class="breadcrumb font-14 font-w-300">
                        <a href="#" class="no-underline">Pipeline Management System</a>
                        <i class="fa fa-angle-right"></i>
                        <a href="#" class="no-underline">Prospects</a>
                    </div>

                    <div class="selected-filters font-13 font-w-300">
                        <ul>
                            <?php if (!empty($params)): ?>
                                <?php foreach ($params as $kay => $param): ?>
                                    <li class="brd-rad-4">
                                        <a href="#" class="no-underline"><?= $param['title'] ?></a>
                                        <?= Html::a(
                                            '',
                                            $param['url'],
                                            ['class' => 'close-item']);
                                        ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <!--                            <li class="brd-rad-4">-->
                            <!--                                <a href="#" class="no-underline">01.02.17 - 01.10.17</a>-->
                            <!--                                <a href="#" class="close-item" title="Remove filter"></a>-->
                            <!--                            </li>-->
                            <!--                            <li class="brd-rad-4">-->
                            <!--                                <a href="#" class="no-underline">Some other filter</a>-->
                            <!--                                <a href="#" class="close-item" title="Remove filter"></a>-->
                            <!--                            </li>-->
                        </ul>
                    </div>
                    <div class="filter-tools">
                        <?php
                        $class = Yii::$app->request->Get('f') ? 'fa-star' : 'fa-star-o';
                        echo Html::a(
                            '',
                            Helper::GetFilterUrl(['/site/index'], Yii::$app->request->Get(), 'f', Yii::$app->request->Get('f') ? 0 : 1),
                            ['class' => 'fa ' . $class . ' rating no-underline']);
                        ?>
                        <!--                        <a href="/site/index?fav=1" class="fa fa-star-o rating no-underline"></a>-->
                        <a href="#" class="fa fa-bell-o feedback p-rel no-underline"><em
                                    class="p-abs white-txt txt-center font-w-700">2</em></a>
                        <!--                        <a class="fa fa-eye-slash publicity no-underline"></a>-->
                        <?= Html::a('', [Yii::$app->request->url, 'arch' => 1], ['class' => 'fa fa-eye-slash publicity no-underline']); ?>
                        <!--                        <a class="fa fa-archive archive no-underline"></a>-->
                        <?php
                        $class = Yii::$app->request->Get('a') ? 'fa-archive fa-archive-active' : 'fa-archive';
                        echo Html::a(
                            '',
                            Helper::GetFilterUrl(['/site/index'], Yii::$app->request->Get(), 'a', Yii::$app->request->Get('a') ? 0 : 1),
                            ['class' => 'fa ' . $class . ' archive no-underline']);
                        ?>
                        <a class="fa fa-asterisk settings no-underline"></a>
                        <label class="fa fa-filter filtering p-rel" for="show-filtering-popup">
                            <i class="fa fa-angle-down font-14"></i>
                            <input type="checkbox" id="show-filtering-popup">
                            <div class="filtering-popup-layer">
                                <div class="filtering-popup brd-rad-4 font-15 p-rel">
                                    <i class="p-abs popup-close" title="Close"></i>
                                    <label for="applied">
                                        <input type="checkbox" id="applied" checked>
                                        <strong class="bullet p-rel brd-rad-4"></strong>
                                        <span class="font-w-300">Applied</span>
                                    </label>
                                    <label for="important">
                                        <input type="checkbox" id="important" checked>
                                        <strong class="bullet p-rel brd-rad-4"></strong>
                                        <span class="font-w-300">Important</span>
                                    </label>
                                    <label for="accepted">
                                        <input type="checkbox" id="accepted">
                                        <strong class="bullet p-rel brd-rad-4"></strong>
                                        <span class="font-w-300">Accepted</span>
                                    </label>
                                    <label for="closed">
                                        <input type="checkbox" id="closed">
                                        <strong class="bullet p-rel brd-rad-4"></strong>
                                        <span class="font-w-300">Closed</span>
                                    </label>
                                    <label for="rejected">
                                        <input type="checkbox" id="rejected">
                                        <strong class="bullet p-rel brd-rad-4"></strong>
                                        <span class="font-w-300">Rejected</span>
                                    </label>
                                    <label for="subcontract">
                                        <input type="checkbox" id="subcontract">
                                        <strong class="bullet p-rel brd-rad-4"></strong>
                                        <span class="font-w-300">Subcontract</span>
                                    </label>
                                    <div class="list-data">
                                        <select size="1" class="d-block font-w-300 brd-rad-4 w-100-perc">
                                            <option value="-1">Select prospect topic</option>
                                        </select>
                                    </div>
                                    <div class="list-data">
                                        <select size="1" class="d-block font-w-300 brd-rad-4 w-100-perc">
                                            <option value="-1">Select countries</option>
                                        </select>
                                    </div>
                                    <div class="date-range d-flex">
                                        <label class="p-rel brd-rad-4">
                                            <input type="text" class="font-w-300 w-100-perc brd-rad-4"
                                                   value="24.03.2017">
                                            <i class="fa fa-calendar p-abs"></i>
                                        </label>
                                        <i>-</i>
                                        <label class="p-rel brd-rad-4">
                                            <input type="text" class="font-w-300 w-100-perc brd-rad-4"
                                                   value="24.09.2017">
                                            <i class="fa fa-calendar p-abs"></i>
                                        </label>
                                    </div>
                                    <button class="d-block font-15 white-bg font-w-700">Apply filters</button>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>


                <div class="center-area">
                    <?php if (!empty($date)): ?>)
                        <?php foreach ($date as $kay => $projects): ?>
                            <fieldset class="posts-list">
                                <legend class="font-12 txt-center black-txt txt-upper"><?= $kay ?></legend>
                                <?php foreach ($projects as $k => $project): ?>
                                    <?= $this->render('project', [
                                        'project' => $project,
                                        'favorites' => $favorites,

                                    ]) ?>
                                <?php endforeach; ?>
                            </fieldset>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            <!--            <div class="right-slide white-bg w-100-perc">-->
            <!--                <div class="widget members-widget">-->
            <!--                    <div class="widget-title-bar d-flex">-->
            <!--                        <span class="widget-title txt-upper font-w-700 black-txt">members</span>-->
            <!--                        <a href="#" class="add-member font-12 font-w-300 no-underline"><i class="fa fa-user-plus"></i>add-->
            <!--                            member</a>-->
            <!--                        <a href="#" class="close-item"></a>-->
            <!--                    </div>-->
            <!--                    <div class="widget-content">-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-1.png" alt="Member 1" title="Member 1"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-2.png" alt="Member 2" title="Member 2"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-3.png" alt="Member 3" title="Member 3"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-4.png" alt="Member 4" title="Member 4"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-5.png" alt="Member 5" title="Member 5"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-6.png" alt="Member 6" title="Member 6"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-7.png" alt="Member 7" title="Member 7"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-8.png" alt="Member 8" title="Member 8"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-9.png" alt="Member 9" title="Member 9"></a>-->
            <!--                        </div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-10.png" alt="Member 10"-->
            <!--                                        title="Member 10"></a></div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-11.png" alt="Member 11"-->
            <!--                                        title="Member 11"></a></div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-12.png" alt="Member 12"-->
            <!--                                        title="Member 12"></a></div>-->
            <!--                        <div class="member-photo brd-rad-4"><a href="#" class="d-block"><img-->
            <!--                                        src="/main/assets/images/members/member-13.png" alt="Member 13"-->
            <!--                                        title="Member 13"></a></div>-->
            <!--                    </div>-->
            <!--                    <div class="widget-title-bar d-flex">-->
            <!--                        <span class="widget-title txt-upper font-w-700 black-txt">activity</span>-->
            <!--                    </div>-->
            <!--                    <div class="widget-content font-15">-->
            <!--                        <div class="member-post d-flex">-->
            <!--                            <div class="member-photo brd-rad-4"><img src="/main/assets/images/members/member-1.png"-->
            <!--                                                                     alt="Member 1" title="Member 1"></div>-->
            <!--                            <div><strong class="font-w-700">Any Hakobyan</strong> created new prospect <a href="#">Invitation-->
            <!--                                    to Bid: Software solution for the regulatory Impact analysis</a> on <span-->
            <!--                                        class="font-w-300">05 Sept 2017</span> at <span class="font-w-300">16:05</span>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="member-post d-flex">-->
            <!--                            <div class="member-photo brd-rad-4"><img src="/main/assets/images/members/member-1.png"-->
            <!--                                                                     alt="Member 1" title="Member 1"></div>-->
            <!--                            <div><strong class="font-w-700">Any Hakobyan</strong> created new prospect <a href="#">Software-->
            <!--                                    solution for the regulatory Impact analysis</a> on <span class="font-w-300">05 Sept 2017</span>-->
            <!--                                at <span class="font-w-300">16:05</span></div>-->
            <!--                        </div>-->
            <!--                        <div class="member-post d-flex">-->
            <!--                            <div class="member-photo brd-rad-4"><img src="/main/assets/images/members/member-1.png"-->
            <!--                                                                     alt="Member 1" title="Member 1"></div>-->
            <!--                            <div><strong class="font-w-700">Any Hakobyan</strong> created new prospect <a href="#">Invitation-->
            <!--                                    to Bid: Software solution for the regulatory Impact analysis</a> on <span-->
            <!--                                        class="font-w-300">05 Sept 2017</span> at <span class="font-w-300">16:05</span>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="member-post d-flex">-->
            <!--                            <div class="member-photo brd-rad-4"><img src="/main/assets/images/members/member-1.png"-->
            <!--                                                                     alt="Member 1" title="Member 1"></div>-->
            <!--                            <div><strong class="font-w-700">Any Hakobyan</strong> created new prospect <a href="#">Invitation-->
            <!--                                    to Bid: Software solution for the regulatory Impact analysis</a> on <span-->
            <!--                                        class="font-w-300">05 Sept 2017</span> at <span class="font-w-300">16:05</span>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="member-post d-flex">-->
            <!--                            <div class="member-photo brd-rad-4"><img src="/main/assets/images/members/member-1.png"-->
            <!--                                                                     alt="Member 1" title="Member 1"></div>-->
            <!--                            <div><strong class="font-w-700">Any Hakobyan</strong> created new member <a href="#">Vladislav-->
            <!--                                    Muradyan</a> on <span class="font-w-300">05 Sept 2017</span> at <span-->
            <!--                                        class="font-w-300">16:05</span></div>-->
            <!--                        </div>-->
            <!--                        <a href="#" class="view-all d-block txt-center"><i class="fa fa-angle-right"></i>view all-->
            <!--                            activities</a>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</div>
