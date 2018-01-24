<?php
use yii\helpers\Html;
use frontend\components\Helper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $favorites */
/* @var $stats */

$this->registerCssFile('/main/assets/css/style.css');
$this->registerCssFile('//hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css');
$this->registerCssFile('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerCssFile('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css');

$this->registerJsFile('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
$this->registerJsFile('/main/assets/js/custom.js');

$this->registerJsFile('//code.jquery.com/ui/1.12.1/jquery-ui.js');
$this->registerJsFile('//hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js');
$this->registerJsFile('//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js');

$this->registerJsFile('/js/Jquery/jquery.timeago.js');
$this->registerJsFile('/js/Project/update-projects.js');
$this->registerJsFile('/js/Project/SaveTexts.js');
$this->registerJsFile('/js/Project/attachments.js');
$this->registerJsFile('/js/Project/favorite.js');
$this->registerJsFile('/js/Project/filter.js');
$this->registerJsFile('/js/popups/src.js');
$this->registerJsFile('/js/Project/popup.js');
$this->registerJsFile('/js/Project/set-data-popup.js');
$this->registerJsFile('/js/Project/Members.js');
$this->registerJsFile('/js/Project/checklists.js');
$this->registerJsFile('/js/Project/status.js');
$this->registerJsFile('/js/notifications/not.js');


$this->title = 'Grant Thornton';
?>

<div class="container d-flex">
    <?= $this->render('/common/left-menu', ['active' => 'prospects']) ?>
    <div class="wrapper">
        <?= $this->render('/common/top-bar') ?>
        <div class="main d-flex">
            <div class="w-100-perc">
                <div class="filter-bar d-flex w-100-perc">
                    <i id="show-left-slide" class="fa fa-arrow-circle-left brd-rad-4"></i>
                    <i id="show-right-slide" style="display: none" class="fa fa-arrow-circle-right brd-rad-4"></i>
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
                    <div class="filter-tools filter-tools nowrap">
                        <a href="#" id="notification" class="fa fa-bell-o feedback p-rel no-underline">
                            <em style="display: none" class="p-abs white-txt txt-center font-w-700">2</em>
                        </a>
                        <?php
                        $class = Yii::$app->request->Get('f') ? 'fa-star' : 'fa-star-o';
                        echo Html::a(
                            '',
                            Helper::GetFilterUrl(['/site/index'], Yii::$app->request->Get(), 'f', Yii::$app->request->Get('f') ? 0 : 1),
                            [
                                'class' => 'fa ' . $class . ' rating no-underline',
                                'title' => 'Favorite'
                            ]);
                        ?>
                        <?php
                        $class = Yii::$app->request->Get('a') ? 'fa-archive fa-archive-active' : 'fa-archive';
                        echo Html::a(
                            '',
                            Helper::GetFilterUrl(['/site/index'], Yii::$app->request->Get(), 'a', Yii::$app->request->Get('a') ? 0 : 1),
                            [
                                'class' => 'fa ' . $class . ' archive no-underline',
                                'title' => 'Archive'
                            ]);
                        ?>
                        <label class="fa fa-filter filtering p-rel" for="show-filtering-popup" id="filtering-icon">
                            <i title="Others filters" class="fa fa-angle-down font-14"></i>
                        </label>
                        <div class="notifications">
                            <ul id="notifications_list">
                                <li><a href="">Text</a></li>
                                <li><a href="">Text</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="center-area" id="projects"></div>
            </div>
        </div>
    </div>
</div>

<div id="popup-filtering" class="filtering-popup-layer">
    <form action="<?= \Yii::$app->request->getAbsoluteUrl() ?>" method="GET" id="id_filter_form">
        <div class="filtering-popup brd-rad-4 font-15 p-rel">
            <i class="p-abs popup-close" title="Close"></i>
            <label for="Pending_approval">
                <input type="checkbox" <?= !empty($get['pending_approval']) ? 'checked' : '' ?> name="pending_approval"
                       id="Pending_approval">
                <strong class="bullet p-rel brd-rad-4"></strong>
                <span class="font-w-300">Pending approval</span>
            </label>
            <label for="In_progress">
                <input type="checkbox" <?= !empty($get['in_progress']) ? 'checked' : '' ?> name="in_progress"
                       id="In_progress">
                <strong class="bullet p-rel brd-rad-4"></strong>
                <span class="font-w-300">In progress</span>
            </label>
            <label for="Submitted">
                <input type="checkbox" <?= !empty($get['submitted']) ? 'checked' : '' ?> name="submitted"
                       id="Submitted">
                <strong class="bullet p-rel brd-rad-4"></strong>
                <span class="font-w-300">Submitted</span>
            </label>
            <label for="Accepted">
                <input type="checkbox" <?= !empty($get['accepted']) ? 'checked' : '' ?> name="accepted"
                       id="Accepted">
                <strong class="bullet p-rel brd-rad-4"></strong>
                <span class="font-w-300">Accepted</span>
            </label>
            <label for="Rejected">
                <input type="checkbox" <?= !empty($get['rejected']) ? 'checked' : '' ?> name="rejected"
                       id="Rejected">
                <strong class="bullet p-rel brd-rad-4"></strong>
                <span class="font-w-300">Dismissed</span>
            </label>
            <label for="Closed">
                <input type="checkbox" <?= !empty($get['closed']) ? 'checked' : '' ?> name="closed"
                       id="Closed">
                <strong class="bullet p-rel brd-rad-4"></strong>
                <span class="font-w-300">Rejected</span>
            </label>
            <!--        <div class="list-data">-->
            <!--            <select size="1" class="d-block font-w-300 brd-rad-4 w-100-perc">-->
            <!--                <option value="-1">Select prospect topic</option>-->
            <!--            </select>-->
            <!--        </div>-->
            <div class="list-data">
                <select size="1" name="country" class="d-block font-w-300 brd-rad-4 w-100-perc">
                    <option value="" disabled selected>Select countries</option>
                    <?php foreach ($countries as $kay => $s): ?>
                        <option <?= (!empty($get['countrie']) && $kay == $get['countrie']) ? 'selected' : '' ?>
                                value="<?= $kay ?>"><?= $s ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="date-range d-flex">
                <label class="p-rel brd-rad-4">
                    <input id="id_deadline_from" name="deadline_from" type="text"
                           class="font-w-300 w-100-perc brd-rad-4"
                           placeholder="Deadline from"
                           value="<?= !empty($get['deadline_from']) ? Html::encode($get['deadline_from']) : '' ?>">
                    <i class="fa fa-calendar p-abs"></i>
                </label>
                <i>-</i>
                <label class="p-rel brd-rad-4">
                    <input id="id_deadline_to" name="deadline_to" type="text"
                           class="font-w-300 w-100-perc brd-rad-4"
                           placeholder="Deadline to"
                           value="<?= !empty($get['deadline_to']) ? Html::encode($get['deadline_to']) : '' ?>">
                    <i class="fa fa-calendar p-abs"></i>
                </label>
            </div>
            <button id="id_filter_submit" class="d-block font-15 white-bg font-w-700">Apply filters</button>
        </div>
    </form>
</div>
<div id="popup-project" class="filtering-popup-layer active-popup">
    <div id="id_project" style="display:none;" data-id=""
         class="filtering-popup card-detail-popup brd-rad-4 font-15 p-rel">
        <i class="popup-close p-abs" title="Close"></i>
        <div class="card-detail-title txt-without-icon">
            <?php if (Yii::$app->rule_check->CheckByKay(['add_new_and_menage_prospects'])): ?>
                <textarea id="id_project_title" class="font-w-700 brd-rad-4 w-100-perc"></textarea>
            <?php else: ?>
                <h1 id="id_project_title" class="font-w-700 brd-rad-4 w-100-perc"></h1>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="card-post-items">
                <div class="txt-without-icon">in list <a href="#"><span id="id_project_country" title="Country"></span></a>
                </div>
                <br><br>
                <div class="txt-without-icon">
                    <div class="post-responsible-people font-15 font-w-700">
                        <span class="d-block">Responsible people</span>
                        <span id="id_project_members"></span>
                        <?php if (Yii::$app->rule_check->CheckByKay(['add_new_decision_makers'])): ?>
                            <a href="#" id="id_add_members" title="Add members" class="add-member font-14 font-w-700"><i
                                        class="fa fa-user-plus"></i>Assign other members</a>
                            <select id="id_members" title="Select a member" style="display: none"
                                    class="change-status-type padding-5 transparent-bg  gray-txt font-15">
                                <option value="0">Select a members</option>
                            </select>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="txt-without-icon">
                    Description
                    <?php if (Yii::$app->rule_check->CheckByKay(['add_new_and_menage_prospects'])): ?>
                        <a href="#" title="Edit project description" id="id_edit_project_des">Edit</a>
                    <?php endif; ?>
                    <span id="id_project_des" class="d-block description-txt"></span>
                    <textarea style="display: none"
                              class="d-block description-txt w-100-perc"
                              id="id_project_des_text"></textarea>
                </div>
                <!---------------------info-------------------------->
                <br>
                <div class="project-info">
                    <div class="txt-without-icon" id="id_tender_stage">
                        Tender stage:
                        <span class="d-block description-txt"></span>
                    </div>
                    <div class="txt-without-icon" id="id_budget">
                        Budget:
                        <span class="d-block description-txt"></span>
                    </div>
                    <div class="txt-without-icon" id="id_duration">
                        Duration:
                        <span class="d-block description-txt"></span>
                    </div>
                    <div class="txt-without-icon" id="id_eligibility_restrictions">
                        Eligibility Restrictions:
                        <span class="d-block description-txt"></span>
                    </div>
                    <div class="txt-without-icon" id="id_selection_method">
                        Selection Method:
                        <span class="d-block description-txt"></span>
                    </div>
                    <div class="txt-without-icon" id="id_evaluation_decision_making">
                        Evaluation Decision Making:
                        <span class="d-block description-txt"></span>
                    </div>
                    <div class="txt-without-icon" id="id_beneficiary_stakeholder">
                        Beneficiary Stakeholder:
                        <span class="d-block description-txt"></span>
                    </div>
                </div>
                <!----------------------------------------------->
                <div class="txt-without-icon">
                    <h6 class="font-w-700 font-16">Attachments</h6>
                </div>
                <span id="id_project_attachments"></span>
                <?php if (Yii::$app->rule_check->CheckByKay(['add_new_and_menage_prospects'])): ?>
                    <div class="txt-without-icon">
                        <div id="fileuploader" style="display: none">Upload</div>
                        <a href="#" title="Attach new file" id="id_attach_file" class="add-member font-14 font-w-700"><i
                                    class="fa fa-paperclip"></i>Attach file</a>
                    </div>
                <?php endif; ?>
                <br>
                <div id="id_checklist_block" style="display: none">
                    <div class="txt-with-icon no-margin">
                        <h6 class="font-w-700 font-15 txt-upper"><i class="fa fa-calendar-check-o"></i>Checklist</h6>
                        &nbsp;<?php if (Yii::$app->rule_check->CheckByKay(['assign_tasks'])): ?>
                            <a href="#edit" title="Edit checklist" id="id_checklist_edit">Edit</a>
                        <?php endif; ?>
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
                        <textarea id="id_comment"
                                  class="d-block font-w-300 brd-rad-4 w-100-perc"
                                  placeholder="Write a comment..."></textarea>
                        <button class="font-13 white-bg font-w-300"
                                id="id_sent_comment"
                                title="Submit comment"
                                readonly>Send
                        </button>
                    </div>
                </div>
                <span id="id_commnets_data"></span>
            </div>
            <div class="card-control-toolkit">
                <ul>
                    <li>
                        <span class="d-block gray-txt margin-btn-5 font-w-300" title="Date created">
                            <i class="fa fa-clock-o"></i> Created: <span id="id_project_created">
                            </span>
                        </span>
                    </li>
                    <li>
                        <span class="d-block gray-txt margin-btn-5 font-w-700"
                              title="Deadline project">
                            <i class="fa fa-clock-o"></i> Deadline: <span id="id_project_deadline">
                            </span>
                        </span>
                    </li>
                </ul>
                <h6 class="font-w-700 font-16">Project Status</h6>
                <ul>
                    <li>
                        <div id="id_status_title" title="Project status"
                             class="post-status in-progress font-w-700 txt-upper"></div>
                    </li>
                </ul>
                <div id="id_buttons">
                    <?php if (Yii::$app->rule_check->CheckByKay(['status_changes'])): ?>
                        <ul>
                            <li>
                                <button style="display: none"
                                        id="id_submit"
                                        title="Submit project"
                                        class="txt-upper status-class green-txt transparent-bg green-border font-18 w-100-perc font-w-700 padding-5">
                                    <i class="fa fa-check"></i> Submit
                                </button>
                            </li>
                            <li>
                                <button style="display:none;"
                                        id="id_approve"
                                        title="Approve project"
                                        class="txt-upper status-class green-bg white-txt no-border font-18 w-100-perc font-w-700 padding-5">
                                    <i class="fa fa-check"></i> Approve
                                </button>
                            </li>
                            <li>
                                <button style="display:none;"
                                        id="id_reject"
                                        title="Reject project"
                                        class="txt-upper status-class transparent-bg red-border font-15 w-100-perc font-w-700">
                                    <i class="fa fa-times"></i> Dismiss
                                </button>
                            </li>
                            <li>
                                <button style="display:none;"
                                        id="id_accepted"
                                        title="Accepted project"
                                        class="txt-upper status-class green-txt transparent-bg green-border font-18 w-100-perc font-w-700 padding-5">
                                    <i class="fa fa-check"></i> Accepted
                                </button>
                            </li>
                            <li>
                                <button style="display:none;"
                                        id="id_closed"
                                        title="Closed project"
                                        class="txt-upper status-class transparent-bg red-border font-15 w-100-perc font-w-700">
                                    <i class="fa fa-times"></i> Rejected
                                </button>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <select style="display: none"
                                        id="id_change_status"
                                        class="change-status-type padding-5 transparent-bg  gray-txt font-15 w-100-perc">
                                    <option>Change status</option>
                                    <?php foreach ($stats as $kay => $s): ?>
                                        <option value="<?= $kay ?>"><?= $s ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <?php if (Yii::$app->rule_check->CheckByKay(['assign_tasks'])): ?>
                        <ul>
                            <li>
                                <button style="display:none;"
                                        id="id_add_checklist"
                                        class="transparent-bg violet-border violet-txt font-15 w-100-perc font-w-500">
                                    <i class="fa fa-calendar-check-o"></i> Create checklist
                                </button>

                                <div style="display: none" id="id_create_checklist"
                                     class="subpopup filtering-popup card-detail-popup brd-rad-4 p-rel">
                                    <div class="list-data">
                                        <span>Title</span>
                                        <input id="id_checklist_title"
                                               type="text"
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
                                        <input id="id_checklist_deadline"
                                               type="text"
                                               class="d-block font-w-300 brd-rad-4 w-100-perc">
                                    </div>
                                    <div class="post-responsible-people font-15 font-w-700">
                                        <span class="d-block">Responsible people</span>
                                        <span id="id_checklist_members"></span>
                                        &nbsp;
                                        <a href="#" id="id_checklist_add_members" title="Add members"
                                           class="add-member font-14 font-w-700">
                                            <i class="fa fa-user-plus"></i>Assign other members
                                        </a>
                                        <select id="id_checklist_members_list"
                                                title="Select a member"
                                                style="display: none"
                                                class="change-status-type padding-5 transparent-bg  gray-txt font-15">
                                            <option>Select a members</option>
                                        </select>
                                    </div>
                                    <!--                            <label for="checklist-status" style="width:auto;">-->
                                    <!--                                <input type="checkbox" id="checklist-status">-->
                                    <!--                                <strong class="bullet p-rel brd-rad-4"></strong>-->
                                    <!--                                <span class="font-w-300">Checklist Status</span>-->
                                    <!--                            </label>-->
                                    <div class="list-data" id="id_checklist_buttons">

                                        <button title="Save" id="id_save_checklist"
                                                class="red-border d-block font-15 white-bg font-w-700">
                                            Create
                                        </button>
                                        <button title="Cencel" id="id_cancel_checklist"
                                                class="red-border d-block font-15 white-bg font-w-700">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="id_loader" style="width: 80px">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"
             preserveAspectRatio="xMidYMid" class="lds-flickr">
            <circle ng-attr-cx="{{config.cx1}}" cy="50" ng-attr-fill="{{config.c1}}" ng-attr-r="{{config.radius}}"
                    cx="39.3333" fill="#00adc7" r="20">
                <animate attributeName="cx" calcMode="linear" values="30;70;30" keyTimes="0;0.5;1" dur="1" begin="-0.5s"
                         repeatCount="indefinite"></animate>
            </circle>
            <circle ng-attr-cx="{{config.cx2}}" cy="50" ng-attr-fill="{{config.c2}}" ng-attr-r="{{config.radius}}"
                    cx="60.6667" fill="#ffffff" r="20">
                <animate attributeName="cx" calcMode="linear" values="30;70;30" keyTimes="0;0.5;1" dur="1" begin="0s"
                         repeatCount="indefinite"></animate>
            </circle>
            <circle ng-attr-cx="{{config.cx1}}" cy="50" ng-attr-fill="{{config.c1}}" ng-attr-r="{{config.radius}}"
                    cx="39.3333" fill="#00adc7" r="20">
                <animate attributeName="cx" calcMode="linear" values="30;70;30" keyTimes="0;0.5;1" dur="1" begin="-0.5s"
                         repeatCount="indefinite"></animate>
                <animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1"
                         ng-attr-dur="{{config.speed}}s" repeatCount="indefinite" dur="1s"></animate>
            </circle>
        </svg>
    </div>
</div>

<script>
    var __Get = <?=json_encode($get)?>;
    var __UserId = <?=Yii::$app->user->getId()?>;
    var __CheckListMenage = <?=(Yii::$app->rule_check->CheckByKay(['assign_tasks'])) ? 1 : 0?>;
    var __DecisionMakersMenage = <?=(Yii::$app->rule_check->CheckByKay(['add_new_decision_makers'])) ? 1 : 0?>;
</script>