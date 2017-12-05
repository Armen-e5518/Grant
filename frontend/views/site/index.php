<?php
use yii\helpers\Html;
use frontend\components\Helper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $favorites */

$this->registerJsFile('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
$this->registerJsFile('http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js');
$this->registerJsFile('/js/Project/attachments.js');
$this->registerJsFile('/js/Project/favorite.js');
$this->registerJsFile('/js/popups/src.js');
$this->registerJsFile('/js/Project/popup.js');
$this->registerJsFile('/js/Project/set-data-popup.js');
$this->registerJsFile('/js/Project/Members.js');
//<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
//<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
//<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css');

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
                        <?php
                        $class = Yii::$app->request->Get('a') ? 'fa-archive fa-archive-active' : 'fa-archive';
                        echo Html::a(
                            '',
                            Helper::GetFilterUrl(['/site/index'], Yii::$app->request->Get(), 'a', Yii::$app->request->Get('a') ? 0 : 1),
                            ['class' => 'fa ' . $class . ' archive no-underline']);
                        ?>
                        <label class="fa fa-filter filtering p-rel" for="show-filtering-popup" id="filtering-icon">
                            <i class="fa fa-angle-down font-14"></i>
                        </label>
                    </div>
                </div>
                <div class="center-area" id="projects">
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
        </div>
    </div>
</div>

<div id="popup-filtering" class="filtering-popup-layer">
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

<div id="popup-project" class="filtering-popup-layer">
    <div id="id_project" data-id="" class="filtering-popup card-detail-popup brd-rad-4 font-15 p-rel">
        <i class="popup-close p-abs" title="Close"></i>
        <div class="card-detail-title txt-without-icon">
            <textarea id="id_project_title" class="font-w-700 brd-rad-4 w-100-perc"></textarea>
        </div>

        <div class="card-body">
            <div class="card-post-items">

                <div class="txt-without-icon">
                    in list <a href="#"><span id="id_project_country"></span> / Audit</a>
                </div>
                <br><br>
                <div class="txt-without-icon">
                    <div class="post-responsible-people font-15 font-w-700">
                        <span class="d-block">Responsible people</span>
                        <span id="id_project_members"></span>
                        &nbsp;
                        <a href="#" id="id_add_members" class="add-member font-14 font-w-700"><i class="fa fa-user-plus"></i>Assign other members</a>
                        <select id="id_members" style="display: none"  class="change-status-type padding-5 transparent-bg gray-border gray-txt font-15">
                            <option value="0">Select a members</option>
                        </select>
                    </div>
                </div>


                <div class="txt-without-icon">
                    Description <a href="#">Edit</a>
                    <span id="id_project_des" class="d-block description-txt"></span>
                </div>
                <br>
                <div class="txt-without-icon">
                    <h6 class="font-w-700 font-16">Attachments</h6>
                </div>
                <span id="id_project_attachments"></span>

                <div class="txt-without-icon">
                    <div id="fileuploader" style="display: none">Upload</div>
                    <a href="#" id="id_attach_file" class="add-member font-14 font-w-700"><i class="fa fa-paperclip"></i>Attach file</a>
                </div>
                <br>
                <div class="txt-with-icon no-margin">
                    <h6 class="font-w-700 font-15 txt-upper"><i class="fa fa-calendar-check-o"></i>Checklist</h6>
                    &nbsp;
                    <a href="#">Edit</a>
                </div>

                <div class="txt-with-icon">
                    <div class="post-priority d-flex w-100-perc gray-bg">
                        <span class="green brd-rad-4" style="flex:unset; width:50%;"></span>
                    </div>
                    <span>50%</span>
                </div>

                <div class="txt-without-icon p-rel disabled-area">
                    <label for="checklist-id-1" class="p-abs" style="left:0;">
                        <input type="checkbox" checked id="checklist-id-1">
                        <strong class="bullet p-rel brd-rad-4"></strong>
                    </label>
                    <del class="d-block gray-txt font-w-500 margin-btn-5 italic">Prepare proposal and send for review to Gurgen.</del>
                    <span class="d-block gray-txt font-w-300 margin-btn-5">Responsible: Olga Semyonova, Isabella Khaneyan</span>
                    <div class="member-photo brd-rad-4">
                        <a href="#" class="d-block p-rel">
                            <img src="/assets/images/members/member-7.png">
                            <em class="tooltip p-abs brd-rad-4 font-12 white-txt">anun azganun</em>
                        </a>
                    </div>
                    <div class="member-photo brd-rad-4">
                        <a href="#" class="d-block p-rel">
                            <img src="/assets/images/members/member-1.png">
                            <em class="tooltip p-abs brd-rad-4 font-12 white-txt">anun azganun</em>
                        </a>
                    </div>
                    <span class="d-block red-txt font-w-300">Deadline: 28 Nov 2017</span>
                </div>

                <div class="txt-without-icon p-rel">
                    <label for="checklist-id-2" class="p-abs" style="left:0;">
                        <input type="checkbox" id="checklist-id-2">
                        <strong class="bullet p-rel brd-rad-4"></strong>
                    </label>
                    <span class="d-block font-w-500 margin-btn-5">Discuss technical details and budget and submit proposal.</span>
                    <span class="d-block gray-txt font-w-300 margin-btn-5">Responsible: Isabella Khaneyan</span>
                    <div class="member-photo brd-rad-4">
                        <a href="#" class="d-block p-rel">
                            <img src="/assets/images/members/member-1.png">
                            <em class="tooltip p-abs brd-rad-4 font-12 white-txt">anun azganun</em>
                        </a>
                    </div>
                    <span class="d-block red-txt font-w-300">Deadline: 28 Nov 2017</span>
                </div>

                <div class="txt-with-icon">
                    <div class="w-100-perc">
                        <h6 class="font-w-700 font-15 txt-upper">Discussion board</h6>
                    </div>
                </div>
                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="HB" title="Haik Beglaryan"></i>
                    <div class="w-100-perc">
                        <textarea class="d-block font-w-300 brd-rad-4 w-100-perc" placeholder="Wright a comment..."></textarea>
                        <button class="font-13 white-bg font-w-300" readonly>Send</button>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Davit Torosyan</a>
                        <span>moved this card from Validated to Doing</span>
                        <a href="#" class="d-block font-13 no-underline">18 Oct at 15:15</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="IB" title="Irena Balayan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Irena Balayan</a>
                        <span class="brd-rad-4 white-bg"><strong class="font-w-700">@davittorosyan</strong> jan sa voncvor arvel e !</span>
                        <a href="#" class="font-13 no-underline">18 Oct at 13:56</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="IB" title="Irena Balayan"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Irena Balayan</a>
                        <span>moved this card from Doing to Validated</span>
                        <a href="#" class="d-block font-13 no-underline">18 Oct at 13:56</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="IB" title="Irena Balayan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Irena Balayan</a>
                        <span class="brd-rad-4 white-bg"><strong class="font-w-700">@davittorosyan</strong> jisht es, sorry))</span>
                        <a href="#" class="font-13 no-underline">16 Oct at 11:59</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Davit Torosyan</a>
                        <span class="brd-rad-4 white-bg"><strong class="font-w-700">@irenabalayan1</strong> jan taskere mix en exel, indz tvuma sa email problem taski patasxanner</span>
                        <a href="#" class="font-13 no-underline">16 Oct at 11:39</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="IB" title="Irena Balayan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Irena Balayan</a>
                        <span class="brd-rad-4 white-bg"><strong class="font-w-700">@davittorosyan</strong> jan chenq stanum, nor pordzecinq</span>
                        <a href="#" class="font-13 no-underline">16 Oct at 11:38</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Davit Torosyan</a>
                        <span class="brd-rad-4 white-bg"><strong class="font-w-700">@irenabalayan1</strong> jan problem fixed</span>
                        <a href="#" class="font-13 no-underline">16 Oct at 11:27</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="IB" title="Irena Balayan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Irena Balayan</a>
                        <span class="brd-rad-4 white-bg"><strong class="font-w-700">@davittorosyan</strong> jan, mobile-ov mardik chen karoxanum grancvel. Xndir@ da e. Duq el pordzeq ktesneq. ej@ kisat e</span>
                        <a href="#" class="font-13 no-underline">16 Oct at 09:42</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Davit Torosyan</a>
                        <span class="brd-rad-4 white-bg"><strong class="font-w-700">@irenabalayan1</strong> jan <a href="#">donate.apps.am</a> um eq nayum?<br>bolor popoxutyunnere petqa <a href="#">donate.apps.am</a> estex nayeq, hastateq, heto nor qcenq <a href="#">donate.am</a></span>
                        <a href="#" class="font-13 no-underline">15 Oct at 17:05</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon font-w-700" data-foo="IB" title="Irena Balayan"></i>
                    <div class="person-repost">
                        <a href="#" class="d-block no-underline font-w-700">Irena Balayan</a>
                        <span class="brd-rad-4 white-bg">Davit jan mobileov chi linum grancvel, ej@ kisat e berum, U @ndhanrapes vorosh ejer kisat en, "FB, Tweeter ..." ays sheet-i patjarov</span>
                        <a href="#" class="font-13 no-underline">15 Oct at 11:58</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Davit Torosyan</a>
                        <span>moved this card from Done to Doing</span>
                        <a href="#" class="d-block font-13 no-underline">12 Oct at 12:53</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="IB" title="Irena Balayan mo"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Irena Balayan mo</a>
                        <span>moved this card from Done to Doing</span>
                        <a href="#" class="d-block font-13 no-underline">12 Oct at 09:45</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Davit Torosyan</a>
                        <span>moved this card from Done to Doing</span>
                        <a href="#" class="d-block font-13 no-underline">11 Oct at 18:24</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Davit Torosyan</a>
                        <span>moved this card from Backlog / Tasks to Done</span>
                        <a href="#" class="d-block font-13 no-underline">11 Oct at 12:40</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="DT" title="Davit Torosyan"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Davit Torosyan</a>
                        <span>added this card to Backlog / Tasks</span>
                        <a href="#" class="d-block font-13 no-underline">11 Oct at 12:40</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="GJ" title="Grigor Janikyan"></i>
                    <div class="person-repost">
                        <a href="#" class="no-underline font-w-700">Grigor Janikyan</a>
                        <span class="d-block brd-rad-4 white-bg"><a href="#">Capture.PNG</a></span>
                        <a href="#" class="font-13 no-underline">11 Oct at 12:40</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>

                <div class="txt-with-icon">
                    <i class="person-icon person-small-icon font-w-700" data-foo="GJ" title="Grigor Janikyan"></i>
                    <div class="person-action">
                        <a href="#" class="no-underline font-w-700">Grigor Janikyan</a>
                        <span>attached Capture.PNG to this card</span>
                        <a href="#" class="d-block attachment-preview p-rel"><img src="https://trello-attachments.s3.amazonaws.com/5a0aba4f2bf80c84d086800d/600x269/760606b0279ee1f57531bd3f7b57f894/Capture.PNG.png" alt=""></a>
                        <a href="#" class="font-13 no-underline">11 Oct at 12:40</a> - <a href="#" class="font-13">Reply</a>
                    </div>
                </div>
            </div>

            <div class="card-control-toolkit">
                <ul>
                    <li>
                        <span class="d-block gray-txt margin-btn-5 font-w-300"><i class="fa fa-clock-o"></i> Created: <span id="id_project_created"></span></span>
                    </li>
                    <li>
                        <span class="d-block gray-txt margin-btn-5 font-w-700"><i class="fa fa-clock-o"></i> Deadline: <span id="id_project_deadline"></span></span>
                    </li>
                </ul>
                <h6 class="font-w-700 font-16">Project Status</h6>
                <ul>
                    <li>
                        <div class="post-status in-progress font-w-700 txt-upper">Submission Process</div>
                    </li>
                </ul>
                <ul>
                    <li>
                        <button class="txt-upper green-txt transparent-bg green-border font-18 w-100-perc font-w-700 padding-5"><i class="fa fa-check"></i> Submit</button>
                    </li>
                </ul>
                <ul>
                    <li>
                        <select size="1" class="change-status-type padding-5 transparent-bg gray-border gray-txt font-15 w-100-perc">
                            <option>Change status</option>
                        </select>
                    </li>
                </ul>
                <ul>
                    <li>
                        <button class="transparent-bg violet-border violet-txt font-15 w-100-perc font-w-500"><i class="fa fa-calendar-check-o"></i> Create checklist</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
