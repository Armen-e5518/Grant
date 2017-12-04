<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $lastname
 * @property string $firstname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $image_url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $country_id
 * @property integer company_id
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile sds
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
            [['username', 'lastname', 'firstname', 'email'], 'required'],
            [['status', 'created_at', 'updated_at', 'country_id', 'company_id'], 'integer'],
            [['username', 'lastname', 'firstname', 'password_hash', 'password_reset_token', 'email', 'image_url'], 'string', 'max' => 255],
            [['auth_key', 'email'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'email'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image_url' => 'Image',
            'country_id' => 'Country',
            'company_id' => 'Company',
        ];
    }

    /**
     * @return bool|string
     */
    public function upload()
    {
        if (!empty($this->imageFile)) {
            $img_name = microtime(true) . '.' . $this->imageFile->extension;
            if ($this->imageFile->saveAs('uploads/' . $img_name)) {
                return $img_name;
            }
        }
        return false;
    }

    /**
     * @return bool|int|mixed|string
     */
    public function SaveUser()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = new \common\models\User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->firstname = $this->firstname;
        $user->lastname = $this->lastname;
        $user->image_url = $this->image_url;
        $user->setPassword($this->password_hash);
        return $user->save() ? $user->getId() : false;
    }

    /**
     * @param null $id
     * @return bool|int
     */
    public function UpdateUser($id = null)
    {
        if (!empty($id)) {
            if (!$this->validate()) {
                return false;
            }
            $user = self::findOne(['id' => $id]);
            $user->username = $this->username;
            $user->email = $this->email;
            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->image_url = $this->image_url;
            $user->country_id = $this->country_id;
            $user->company_id = $this->company_id;
            return $user->save() ? $user->id : false;
        }
        return false;
    }

    /**
     * @return array
     */
    public static function GetUsers()
    {
        return self::find()->select(["CONCAT(`firstname`,' ',`lastname`) as name", 'id'])->indexBy('id')->column();
    }

    public static function GetAllUsersNotProject($project_id)
    {
        return self::find()
            ->where(['NOT IN', 'id', ProjectMembers::GetMembersByProjectId($project_id)])
            ->asArray()
            ->all();
    }

    /**
     * @param $id
     * @return static
     */
    public static function GetUserImage($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * @param $id
     * @return null
     */
    public function GetCompany($id)
    {
        return !empty(Companies::GetCompanyNameById($id)['name']) ? Companies::GetCompanyNameById($id)['name'] : null;
    }

    /**
     * @param $id
     * @return null
     */
    public function GetCountry($id)
    {
        return !empty(Countries::GetCountryNameById($id)['country_name']) ? Countries::GetCountryNameById($id)['country_name'] : null;
    }
}
