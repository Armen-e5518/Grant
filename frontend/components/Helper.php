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
use yii\base\Component;

/**
 * Class CheckRules
 * @package frontend\components
 */
class Helper extends Component
{

    /**
     * @param $data
     * @return array
     */
    public static function ChangeProjectsFormat($data)
    {
        $new_d = [];
        foreach ($data as $kay => $d) {
            $date = date('F Y', strtotime($d['deadline']));
            $new_d[$date][] = $d;
        }
        return $new_d;
    }

    /**
     * @param $url
     * @param $params
     * @param $kay
     * @param $value
     * @return array
     */
    public static function GetFilterUrl($url, $params, $kay, $value)
    {

        if ($value == 0 || empty($value)) {
            unset($params[$kay]);
        } else {
            $params[$kay] = $value;
        }
        return array_merge($url, $params);
    }

    /**
     * @param $url
     * @param $params
     * @return array
     */
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
            if ($kay == 'pending_approval') {
                $new_params[] = [
                    'title' => 'Pending approval',
                    'url' => self::GetFilterUrl($url, $params, 'pending_approval', 0)
                ];
            }
            if ($kay == 'in_progress') {
                $new_params[] = [
                    'title' => 'In progress',
                    'url' => self::GetFilterUrl($url, $params, 'in_progress', 0)
                ];
            }
            if ($kay == 'submitted') {
                $new_params[] = [
                    'title' => 'Submitted',
                    'url' => self::GetFilterUrl($url, $params, 'submitted', 0)
                ];
            }
            if ($kay == 'accepted') {
                $new_params[] = [
                    'title' => 'Accepted',
                    'url' => self::GetFilterUrl($url, $params, 'accepted', 0)
                ];
            }
            if ($kay == 'rejected') {
                $new_params[] = [
                    'title' => 'Rejected',
                    'url' => self::GetFilterUrl($url, $params, 'rejected', 0)
                ];
            }
            if ($kay == 'closed') {
                $new_params[] = [
                    'title' => 'Closed',
                    'url' => self::GetFilterUrl($url, $params, 'closed', 0)
                ];
            }
            if ($kay == 'country') {
                $new_params[] = [
                    'title' => Countries::GetCountryNameById($p)['country_name'],
                    'url' => self::GetFilterUrl($url, $params, 'country', 0)
                ];
            }
            if ($kay == 'deadline_from' && !empty($p)) {
                $new_params[] = [
                    'title' => 'From ' . $p,
                    'url' => self::GetFilterUrl($url, $params, 'deadline_from', 0)
                ];
            }
            if ($kay == 'deadline_to' && !empty($p)) {
                $new_params[] = [
                    'title' => 'To ' . $p,
                    'url' => self::GetFilterUrl($url, $params, 'deadline_to', 0)
                ];
            }
        }
        return $new_params;
    }

    /**
     * @param null $text1
     * @param null $text2
     * @return string
     */
    public static function GetFirstCharacters($text1 = null, $text2 = null)
    {
        $c1 = !empty($text1{0}) ? $text1{0} : '';
        $c2 = !empty($text2{0}) ? $text2{0} : '';
        return ucwords($c1) . ucwords($c2);
    }

    /**
     * @return string
     */
    public static function GetUserCharacters()
    {
        $text1 = \Yii::$app->user->identity->firstname;
        $text2 = \Yii::$app->user->identity->lastname;
        $c1 = !empty($text1{0}) ? $text1{0} : '';
        $c2 = !empty($text2{0}) ? $text2{0} : '';
        return ucwords($c1) . ucwords($c2);
    }

    /**
     * @return string
     */
    public static function GetUserName()
    {
        $text1 = \Yii::$app->user->identity->firstname;
        $text2 = \Yii::$app->user->identity->lastname;
        return $text1 . ' ' . $text2;
    }

    /**
     * @param $project_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function GetChecklist($project_id)
    {
        $Checklists = ProjectChecklists::GetChecklistsByProjectId($project_id);
        foreach ($Checklists as $kay => $Checklist) {
            $Checklists[$kay]['members'] = ChecklistUsers::GetUsersByChecklistIds($Checklist['id']);
        }
        return $Checklists;
    }

    /**
     * @param $id
     * @return array
     */
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
                $s = 'Dismissed';
                $s_class = 'in-progress';
                break;
            case 5:
                $s = 'REJECTED';
                $s_class = 'in-progress';
                break;
        }
        return [
            'title' => $s,
            'class' => $s_class
        ];

    }

    /**
     * @param $actions
     * @param $action
     * @return bool
     */
    public static function CheckAction($actions, $action)
    {
        foreach ($actions as $a) {
            if ($a == $action) {
                return true;
            }
        }
        return false;
    }

    public static function GetMonthAndYear($s_Year, $e_Year)
    {
        $a = [];
        for ($i = $s_Year; $i <= $e_Year; $i++) {
            for ($j = 1; $j <= 12; $j++) {
                $s = $j < 10 ? 0 : '';
                $a[] = $i . '/' . $s . $j;
            }
        }
        return $a;
    }

}