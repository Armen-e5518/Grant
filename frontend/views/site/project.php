<?php
/* @var $project */
/* @var $favorites */
/* @var  $project frontend\models\Projects */

$members = \frontend\models\ProjectMembers::GetMembersByProjectIdAllData($project['id']);
$attachments = \frontend\models\ProjectAttachments::GetAttachmentsByProjectId($project['id']);
$fav_id = array_search($project['id'], $favorites);
$favorite_class = (isset($fav_id)) ? 'fa-star' : 'fa-star-o';

?>

<div class="post-item">
    <div class="post-title-bar d-flex font-15 txt-upper">
        <div class="post-status applied font-w-700">
            <?= $project['status'] == 0 ?
                '<div class="post-status in-progress font-w-700"><i class="fa fa-check"></i>In Progress</div>'
                : '<div class="post-status applied font-w-700"><i class="fa fa-check"></i>Applied</div>' ?>

        </div>
        <div class="post-title black-txt">
            <span><?= $project['project_name'] ?></span>
        </div>
        <div class="post-priority d-flex">
            <?php if ($project['pending_approval']): ?>
                <span class="red p-rel brd-rad-4">
                <em class="tooltip p-abs brd-rad-4 font-12 white-txt">Pending Approval</em>
            </span>
            <?php endif; ?>
            <?php if ($project['submitted']): ?>
                <span class="green p-rel brd-rad-4">
                <em class="tooltip p-abs brd-rad-4 font-12 white-txt">Submitted</em>
            </span>
            <?php endif; ?>
            <?php if ($project['submission_process']): ?>
                <span class="pink p-rel brd-rad-4">
                <em class="tooltip p-abs brd-rad-4 font-12 white-txt">Submission Process</em>
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
                    <a href="<?= Yii::$app->params['attachments_url'] . $attachment['src'] ?>" download=""
                       class="font-w-300">
                        <?= $type . mb_substr($attachment['src'], 0, 20) ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="post-timing">
            <span><i class="fa fa-clock-o"></i><?= $project['request_issued'] ?></span>
            <span><i class="fa fa-clock-o"></i><?= $project['deadline'] ?></span>
        </div>
    </div>
    <div class="post-content font-15">
        <p><?= $project['project_dec'] ?></p>
    </div>
    <div class="post-extras d-flex">
        <div class="post-responsible-people font-13 font-w-700">
            <?php if (!empty($members)): ?>
                <span class="d-block">Responsible people</span>
                <?php foreach ($members as $member): ?>
                    <div class="member-photo brd-rad-4">
                        <a href="#" class="d-block p-rel">
                            <img src="<?= !empty($member['image_url']) ? Yii::$app->params['user_url'] . $member['image_url'] : '/images/no-user.png' ?>">
                            <em class="tooltip p-abs brd-rad-4 font-12 white-txt"><?= $member['firstname'] . ' ' . $member['lastname'] ?> </em>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="post-actions d-flex brd-rad-4 white-bg">
            <a href="#" data-id="<?= $project['id'] ?>"
               class="favorite-project fa <?= $favorite_class ?> rating no-underline black-txt"></a>
            <a href="#" class="fa fa-eye-slash publicity no-underline black-txt"></a>
            <a href="/projects/delete-project?id=<?= $project['id'] ?>"
               class="fa fa-trash removal no-underline black-txt"></a>
            <a href="/projects/update?id=<?= $project['id'] ?>" class="fa fa fa-pencil sharing no-underline"></a>
            <a href="/projects/add-archive?id=<?= $project['id'] ?>" class="fa fa-share sharing no-underline"></a>
        </div>
    </div>
</div>