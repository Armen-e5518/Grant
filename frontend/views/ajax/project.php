<?php
/* @var $project */
/* @var $favorites */
/* @var  $project frontend\models\Projects */

$members = \frontend\models\ProjectMembers::GetMembersByProjectIdAllData($project['id']);
$attachments = \frontend\models\ProjectAttachments::GetAttachmentsByProjectId($project['id']);
$countries = \frontend\models\ProjectCountries::GetCountriesNameByProjectIdString($project['id']);
$fav_id = array_search($project['id'], $favorites);
if ($fav_id !== false) {
    $favorite_class = 'fa-star';
} else {
    $favorite_class = 'fa-star-o';
}
$arch_class = ($project['state'] == 2) ? 'fa-archive-active' : '';
$status = \frontend\components\Helper::GetStatusTitle($project['status']);
?>

<tr class="project" data-id="<?= $project['id'] ?>">
    <td>
        <span title="No"><?= $kay  ?></span>
    </td>
    <td>
        <div class="post-status applied font-w-700">
            <div title="Status" class="post-status <?= $status['class'] ?> font-w-700">
                <i class="fa fa-check"></i><?= $status['title'] ?>
            </div>
        </div>
    </td>
    <td>
        <span title="Ifi Name"><?= $project['ifi_name'] ?></span>
    </td>
    <td>
        <span title="Client name"><?= $project['client_name'] ?></span>
    </td>
    <td>
        <span title="Project Name"><?= $project['project_name'] ?></span>
    </td>
    <td>
        <p title="Countries"><?= $countries ?></p>
    </td>
    <td>
        <p title="Tender Stage"><?= $project['tender_stage'] ?></p>
    </td>
    <td>
        <p title="Deadline"><?= $project['deadline'] ?></p>
    </td>
    <td>
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
    </td>
</tr>