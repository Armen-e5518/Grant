<?php
/**
 * Created by PhpStorm.
 * User: Armen
 * Date: 11/20/17
 * Time: 12:00 PM
 */

namespace frontend\components;

use frontend\models\UserRules;
use yii\base\Component;

/**
 * Class CheckRules
 * @package frontend\components
 */
class CheckRules extends Component
{
    /**
     * @var
     */
    public $user_rules;


    /**
     * CheckRules constructor.
     */
    function init()
    {
        parent::init();
        $this->user_rules = UserRules::GetUserRules(\Yii::$app->user->identity->getId());
    }


    /**
     * @param null $rule_kay
     * @return bool
     */
    public function CheckByKay($rule_kay = null)
    {
        if (!empty($rule_kay)) {
            foreach ($rule_kay as $kay) {
                if (empty(array_search($kay, $this->user_rules))) {
                    return false;
                };
            }
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function GetUserRiles()
    {
        return $this->user_rules;
    }
}