<?php
$projects = \frontend\models\Projects::GetAllProjects($get);
$date = \frontend\components\Helper::ChangeProjectsFormat($projects);
?>

<?php if (!empty($date)): ?>
    <?php foreach ($date as $kay => $projects): ?>
        <fieldset class="posts-list">
            <legend class="font-12 txt-center black-txt txt-upper"><?= $kay ?></legend>
            <?php foreach ($projects as $k => $project): ?>
                <?= $this->render('project', [
                    'project' => $project,
                    'favorites' => \frontend\models\ProjectFavorite::GetFavoritesByUserId(),
                ]) ?>
            <?php endforeach; ?>
        </fieldset>
    <?php endforeach; ?>
<?php endif; ?>