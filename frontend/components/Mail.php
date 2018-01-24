<?php
/**
 * Created by PhpStorm.
 * User: Armen
 * Date: 11/20/17
 * Time: 12:00 PM
 */

namespace frontend\components;

use frontend\models\ChecklistUsers;
use frontend\models\Companies;
use frontend\models\Countries;
use frontend\models\ProjectChecklists;
use frontend\models\Projects;
use frontend\models\User;
use yii\base\Component;

/**
 * Class CheckRules
 * @package frontend\components
 */
class Mail extends Component
{


    //Mail::SandMailByType($post['user_id'], $post['project_id'],$post['type']);

    public static function SandMailByType($user_id = 1, $project_id = null, $type = 1)
    {
        if (!empty($user_id) && !empty($project_id)) {
            $user = User::GetUserById($user_id);
            $project = Projects::GetProjectDataById($project_id);
            if ($type == 0) {
                return self::SandMail($user['email'],
                    'You were tagged in the comment',
                    "You were tagged in the comment, Project name: {$project['project_name']} " . \Yii::$app->params['domain']
                );
            } elseif ($type == 1) {
                return self::SandMail(
                    $user['email'],
                    'You have a new project',
                    "You have a new project, Project name: {$project['project_name']} " . \Yii::$app->params['domain']
                );
            }
        }
        return true;
    }

    public static function SandMail($email = null, $title = '', $text = '')
    {
        return \Yii::$app
            ->mailer
            ->compose()
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
            ->setTo($email)
            ->setSubject($title)
            ->setTextBody($text)
            ->send();
    }
}