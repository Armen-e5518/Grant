<?php
/* @var $project */
/* @var $favorites */
/* @var  $project frontend\models\Projects */

$members = \frontend\models\ProjectMembers::GetMembersByProjectIdAllData($project['id']);
$attachments = \frontend\models\ProjectAttachments::GetAttachmentsByProjectId($project['id']);
$fav_id = array_search($project['id'], $favorites);
if ($fav_id !== false) {
    $favorite_class = 'fa-star';
} else {
    $favorite_class = 'fa-star-o';
}
$arch_class = ($project['state'] == 2) ? 'fa-archive-active' : '';
$status = \frontend\components\Helper::GetStatusTitle($project['status']);
?>

<div class="post-item project" data-id="<?= $project['id'] ?>">
    <div class="post-title-bar d-flex font-15 txt-upper">
        <div class="post-status applied font-w-700">
            <div title="Status" class="post-status <?= $status['class'] ?> font-w-700">
                <i class="fa fa-check"></i><?= $status['title'] ?>
            </div>
        </div>
        <div class="post-title black-txt">
            <span title="Project name"><?= $project['project_name'] ?></span>
        </div>
        <div class="post-priority d-flex">
            <?php if ($project['importance_1']): ?>
                <span class="red p-rel brd-rad-4">
                            <em class="tooltip p-abs brd-rad-4 font-12 white-txt">Importance</em>
                        </span>
            <?php endif; ?>
            <?php if ($project['importance_2']): ?>
                <span class="green p-rel brd-rad-4">
                            <em class="tooltip p-abs brd-rad-4 font-12 white-txt">Most important</em>
                        </span>
            <?php endif; ?>
            <?php if ($project['importance_3']): ?>
                <span class="pink p-rel brd-rad-4">
                            <em class="tooltip p-abs brd-rad-4 font-12 white-txt">More important</em>
                        </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="post-relations d-flex font-14">
        <div class="related-documents">
            <?php if (!empty($attachments)): ?>
                <?php foreach ($attachments as $attachment): ?>
                    <?php if ($attachment['type'] == 'pdf') {
                        $type = ' <i class="fa fa-file-pdf-o"></i>';
                    } elseif ($attachment['type'] == 'doc' || $attachment['type'] == 'docx') {
                        $type = '<i class="fa fa-file-word-o"></i>';
                    } elseif ($attachment['type'] == 'jpg' || $attachment['type'] == 'png' || $attachment['type'] == 'jpeg') {
                        $type = '<i class="fa fa-picture-o" aria-hidden="true"></i>';
                    } else {
                        $type = ' <i class="fa fa-file" aria-hidden="true"></i>';
                    } ?>
                    <a href="<?= Yii::$app->params['attachments_url'] . $attachment['src'] ?>"
                       download=""
                       title="<?= $attachment['src'] ?>"
                       class="font-w-300">
                        <?= $type . mb_substr($attachment['src'], 0, 10) ?>...<?= $attachment['type'] ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="post-timing">
            <span title="Request issued"><i class="fa fa-clock-o"></i><?= $project['request_issued'] ?></span>
            <span title="Deadline"><i class="fa fa-clock-o"></i><?= $project['deadline'] ?></span>
        </div>
    </div>
    <div class="post-content font-15">
        <p title="Description"><?= $project['project_dec'] ?></p>
    </div>
    <div class="post-extras d-flex">
        <div class="post-responsible-people font-13 font-w-700">
            <?php if (!empty($members)): ?>
                <span class="d-block">Responsible people</span>
                <?php foreach ($members as $member): ?>
                    <div class="member-photo brd-rad-4">
                        <a href="#" class="d-block p-rel">
                            <img title="<?= $member['firstname'] . ' ' . $member['lastname'] ?>"
                                 src="<?= !empty($member['image_url']) ? Yii::$app->params['user_url'] . $member['image_url'] : '/images/no-user.png' ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="post-actions d-flex brd-rad-4 white-bg">
            <a href="#" data-id="<?= $project['id'] ?>"
               class="favorite-project fa <?= $favorite_class ?> rating no-underline black-txt" title="Favorite"></a>
            <?php if (Yii::$app->rule_check->CheckByKay(['add_new_and_menage_prospects'])): ?>
                <a href="/projects/add-archive?id=<?= $project['id'] ?>"
                   class="fa fa-archive <?= $arch_class ?> sharing no-underline" title="Archive"></a>
            <?php endif; ?>
            <?php if (Yii::$app->rule_check->CheckByKay(['add_new_and_menage_prospects'])): ?>
                <a href="/projects/delete-project?id=<?= $project['id'] ?>"
                   class="fa fa-trash removal no-underline black-txt" title="Delete"></a>
            <?php endif; ?>
            <?php if (Yii::$app->rule_check->CheckByKay(['add_new_and_menage_prospects'])): ?>
                <a href="/projects/update?id=<?= $project['id'] ?>" title="Update"
                   class="fa fa fa-pencil sharing no-underline"></a>
            <?php endif; ?>
        </div>
    </div>
</div>