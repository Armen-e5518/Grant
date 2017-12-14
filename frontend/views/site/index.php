<?php
use yii\helpers\Html;
use frontend\components\Helper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $favorites */
/* @var $stats */

$this->registerCssFile('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

$this->registerJsFile('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
$this->registerJsFile('https://code.jquery.com/ui/1.12.1/jquery-ui.js');
$this->registerJsFile('http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js');
$this->registerJsFile('/js/Jquery/jquery.timeago.js');
$this->registerJsFile('/js/Project/SaveTexts.js');
$this->registerJsFile('/js/Project/attachments.js');
$this->registerJsFile('/js/Project/favorite.js');
$this->registerJsFile('/js/popups/src.js');
$this->registerJsFile('/js/Project/popup.js');
$this->registerJsFile('/js/Project/set-data-popup.js');
$this->registerJsFile('/js/Project/Members.js');
$this->registerJsFile('/js/Project/checklists.js');
$this->registerJsFile('/js/Project/status.js');

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
                    <?php if (!empty($date)): ?>
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

<div id="popup-project" class="filtering-popup-layer active-popup">
    <div id="id_project" style="display:none;" data-id=""
         class="filtering-popup card-detail-popup brd-rad-4 font-15 p-rel">
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
                        <a href="#" id="id_add_members" class="add-member font-14 font-w-700"><i
                                    class="fa fa-user-plus"></i>Assign other members</a>
                        <select id="id_members" style="display: none"
                                class="change-status-type padding-5 transparent-bg gray-border gray-txt font-15">
                            <option value="0">Select a members</option>
                        </select>
                    </div>
                </div>


                <div class="txt-without-icon">
                    Description <a href="#" id="id_edit_project_des">Edit</a>
                    <span id="id_project_des" class="d-block description-txt"></span>
                    <textarea style="display: none" class="d-block description-txt w-100-perc"
                              id="id_project_des_text"></textarea>
                </div>
                <br>
                <div class="txt-without-icon">
                    <h6 class="font-w-700 font-16">Attachments</h6>
                </div>
                <span id="id_project_attachments"></span>

                <div class="txt-without-icon">
                    <div id="fileuploader" style="display: none">Upload</div>
                    <a href="#" id="id_attach_file" class="add-member font-14 font-w-700"><i
                                class="fa fa-paperclip"></i>Attach file</a>
                </div>
                <br>
                <div id="id_checklist_block" style="display: none">
                    <div class="txt-with-icon no-margin">
                        <h6 class="font-w-700 font-15 txt-upper"><i class="fa fa-calendar-check-o"></i>Checklist</h6>
                        &nbsp
                        <a href="#edit" id="id_checklist_edit">Edit</a>
                    </div>
                    <div class="txt-with-icon">
                        <div class="post-priority d-flex w-100-perc gray-bg">
                            <span class="green brd-rad-4" id="id_slider" style="flex:unset; width:50%;"></span>
                        </div>
                        <span id="id_slider_text">50%</span>
                    </div>
                    <span id="id_checklists_data"></span>
                </div>
                <div class="txt-with-icon">
                    <div class="w-100-perc">
                        <h6 class="font-w-700 font-15 txt-upper">Discussion board</h6>
                    </div>
                </div>
                <div class="user-tag" id="id_users_tag" style="display: none">
                    <div class="user-tag-list">
                        <ul id="id_users_list"></ul>
                    </div>
                </div>
                <div class="txt-with-icon">
                    <i class="person-icon font-w-700"
                       data-foo="<?= Helper::GetUserCharacters() ?>"
                       title="<?= Helper::GetUserName() ?>"></i>
                    <div class="w-100-perc">
                        <textarea id="id_comment" class="d-block font-w-300 brd-rad-4 w-100-perc"
                                  placeholder="Wright a comment..."></textarea>
                        <button class="font-13 white-bg font-w-300" id="id_sent_comment" readonly>Send</button>
                    </div>
                </div>
                <span id="id_commnets_data"></span>
            </div>
            <div class="card-control-toolkit">
                <ul>
                    <li>
                        <span class="d-block gray-txt margin-btn-5 font-w-300">
                            <i class="fa fa-clock-o"></i> Created: <span id="id_project_created"></span>
                        </span>
                    </li>
                    <li>
                        <span class="d-block gray-txt margin-btn-5 font-w-700">
                            <i class="fa fa-clock-o"></i> Deadline: <span id="id_project_deadline"></span>
                        </span>
                    </li>
                </ul>
                <h6 class="font-w-700 font-16">Project Status</h6>
                <ul>
                    <li>
                        <div id="id_status_title" class="post-status in-progress font-w-700 txt-upper"></div>
                    </li>
                </ul>
                <div id="id_buttons">
                    <ul>
                        <li>
                            <button style="display: none"
                                    id="id_submit"
                                    class="txt-upper green-txt transparent-bg green-border font-18 w-100-perc font-w-700 padding-5">
                                <i class="fa fa-check"></i> Submit
                            </button>
                        </li>
                        <li>
                            <button style="display:none;"
                                    id="id_approve"
                                    class="txt-upper green-bg white-txt no-border font-18 w-100-perc font-w-700 padding-5">
                                <i class="fa fa-check"></i> Approve
                            </button>
                        </li>
                        <li>
                            <button style="display:none;"
                                    id="id_reject"
                                    class="txt-upper transparent-bg red-border font-15 w-100-perc font-w-700">
                                <i class="fa fa-times"></i> Reject
                            </button>
                        </li>
                        <li>
                            <button style="display:none;"
                                    id="id_accepted"
                                    class="txt-upper green-txt transparent-bg green-border font-18 w-100-perc font-w-700 padding-5">
                                <i class="fa fa-check"></i> Accepted
                            </button>
                        </li>
                        <li>
                            <button style="display:none;"
                                    id="id_closed"
                                    class="txt-upper transparent-bg red-border font-15 w-100-perc font-w-700">
                                <i class="fa fa-times"></i> Closed
                            </button>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <select style="display: none" id="id_change_status"
                                    class="change-status-type padding-5 transparent-bg gray-border gray-txt font-15 w-100-perc">
                                <option>Change status</option>
                                <?php foreach ($stats as $kay => $s): ?>
                                    <option value="<?= $kay ?>"><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <button style="display:none;" id="id_add_checklist"
                                    class="transparent-bg violet-border violet-txt font-15 w-100-perc font-w-500">
                                <i class="fa fa-calendar-check-o"></i> Create checklist
                            </button>

                            <div style="display: none" id="id_create_checklist"
                                 class="subpopup filtering-popup card-detail-popup brd-rad-4 p-rel">
                                <div class="list-data">
                                    <span>Title</span>
                                    <input id="id_checklist_title" type="text"
                                           class="d-block font-w-300 brd-rad-4 w-100-perc">
                                </div>
                                <div class="list-data">
                                    <span>Description</span>
                                    <div class="txt-without-icon no-padding">
                                    <textarea id="id_checklist_desc"
                                              class="d-block font-w-300 brd-rad-4 w-100-perc"></textarea>
                                    </div>
                                </div>

                                <div class="list-data">
                                    <span>Deadline</span>
                                    <input id="id_checklist_deadline" type="text"
                                           class="d-block font-w-300 brd-rad-4 w-100-perc">
                                </div>
                                <div class="post-responsible-people font-15 font-w-700">
                                    <span class="d-block">Responsible people</span>
                                    <span id="id_checklist_members"></span>
                                    &nbsp;
                                    <a href="#" id="id_checklist_add_members" class="add-member font-14 font-w-700">
                                        <i class="fa fa-user-plus"></i>Assign other members
                                    </a>
                                    <select id="id_checklist_members_list"
                                            style="display: none"
                                            class="change-status-type padding-5 transparent-bg gray-border gray-txt font-15">
                                        <option>Select a members</option>
                                    </select>
                                </div>
                                <!--                            <label for="checklist-status" style="width:auto;">-->
                                <!--                                <input type="checkbox" id="checklist-status">-->
                                <!--                                <strong class="bullet p-rel brd-rad-4"></strong>-->
                                <!--                                <span class="font-w-300">Checklist Status</span>-->
                                <!--                            </label>-->
                                <div class="list-data">

                                    <button id="id_save_checklist"
                                            class="red-border d-block font-15 white-bg font-w-700">
                                        Create
                                    </button>
                                    <button id="id_cancel_checklist"
                                            class="red-border d-block font-15 white-bg font-w-700">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="id_loader" style="width: 80px">
        <svg class="lds-spinner" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <g transform="rotate(0 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.9166666666666666s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(30 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.8333333333333334s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(60 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.75s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(90 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.6666666666666666s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(120 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.5833333333333334s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(150 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.5s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(180 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.4166666666666667s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(210 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.3333333333333333s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(240 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.25s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(270 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.16666666666666666s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(300 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="-0.08333333333333333s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
            <g transform="rotate(330 50 50)">
                <rect x="47" y="24" rx="9.4" ry="4.8" width="6" height="12" fill="#bfdbd2">
                    <animate attributeName="opacity" values="1;0" times="0;1" dur="1s" begin="0s"
                             repeatCount="indefinite"></animate>
                </rect>
            </g>
        </svg>
    </div>
</div>
