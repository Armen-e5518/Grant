<?php
/**
 * Created by PhpStorm.
 * User: Armen
 * Date: 11/20/17
 * Time: 12:00 PM
 */

namespace frontend\components;

use frontend\models\ChecklistUsers;
use frontend\models\ProjectChecklists;
use yii\base\Component;

/**
 * Class CheckRules
 * @package frontend\components
 */
class Helper extends Component
{

    public static function ChangeProjectsFormat($data)
    {
        $new_d = [];
        foreach ($data as $kay => $d) {
            $date = date('F Y', strtotime($d['deadline']));
            $new_d[$date][] = $d;
        }
        return $new_d;
    }

    public static function GetFilterUrl($url, $params, $kay, $value)
    {

        if ($value == 0) {
            unset($params[$kay]);
        } else {
            $params[$kay] = $value;
        }
        return array_merge($url, $params);
    }

    public static function GetFilterResets($url, $params)
    {
        $new_params = [];
        foreach ($params as $kay => $p) {
            if ($kay == 'f') {
                $new_params[] = [
                    'title' => 'Favorite',
                    'url' => self::GetFilterUrl($url, $params, 'f', 0)
                ];
            }
            if ($kay == 'a') {
                $new_params[] = [
                    'title' => 'Archive',
                    'url' => self::GetFilterUrl($url, $params, 'a', 0)
                ];
            }
        }
        return $new_params;
    }

    public static function GetFirstCharacters($text1 = null, $text2 = null)
    {
        $c1 = !empty($text1{0}) ? $text1{0} : '';
        $c2 = !empty($text2{0}) ? $text2{0} : '';
        return ucwords($c1) . ucwords($c2);
    }

    public static function GetUserCharacters()
    {
        $text1 = \Yii::$app->user->identity->firstname;
        $text2 = \Yii::$app->user->identity->lastname;
        $c1 = !empty($text1{0}) ? $text1{0} : '';
        $c2 = !empty($text2{0}) ? $text2{0} : '';
        return ucwords($c1) . ucwords($c2);
    }

    public static function GetUserName()
    {
        $text1 = \Yii::$app->user->identity->firstname;
        $text2 = \Yii::$app->user->identity->lastname;
        return $text1 . ' ' . $text2;
    }

    public static function GetChecklist($project_id)
    {
        $Checklists = ProjectChecklists::GetChecklistsByProjectId($project_id);
        foreach ($Checklists as $kay => $Checklist) {
            $Checklists[$kay]['members'] = ChecklistUsers::GetUsersByChecklistIds($Checklist['id']);
        }
        return $Checklists;
    }

    public static function GetStatusTitle($id)
    {
        $s = '';
        $s_class = '';
        switch ($id) {
            case 0:
                $s = 'PENDING APPROVAL';
                $s_class = 'pending';
                break;
            case 1:
                $s = 'SUBMISSION PROCESS';
                $s_class = 'in-progress';
                break;
            case 2:
                $s = 'In progress';
                $s_class = 'in-progress';
                break;
            case 3:
                $s = 'Accepted';
                $s_class = 'applied';
                break;
            case 4:
                $s = 'Rejected';
                $s_class = 'in-progress';
                break;
            case 5:
                $s = 'Closed';
                $s_class = 'in-progress';
                break;
        }
        return [
            'title' => $s,
            'class' => $s_class
        ];

    }
}