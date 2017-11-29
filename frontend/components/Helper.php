<?php
/**
 * Created by PhpStorm.
 * User: Armen
 * Date: 11/20/17
 * Time: 12:00 PM
 */

namespace frontend\components;

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

        if($value == 0){
            unset($params[$kay]);
        }else{
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
}