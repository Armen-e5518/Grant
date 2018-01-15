<?php

namespace frontend\controllers;


use frontend\models\ProjectAttachments;
use frontend\models\ProjectCountries;
use frontend\models\ProjectFavorite;
use frontend\models\ProjectMembers;
use frontend\models\Projects;
use frontend\models\User;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Yii;
use yii\web\Controller;
use \yii\web\Response;


/**
 * UserController implements the CRUD actions for User model.
 */
class FileController extends Controller
{

    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/index']);
            return false;
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Upload File
     */
    public function actionUpload()
    {
        $output_dir = "attachments/";
        if (isset($_FILES["myfile"])) {
            $ret = [];
            $error = $_FILES["myfile"]["error"];
            if (!is_array($_FILES["myfile"]["name"])) {
                $fileName = $_FILES["myfile"]["name"];
                $fileName_arr = explode('.', $fileName);
                $type = end($fileName_arr);
                $new_file_name = '';
                foreach ($fileName_arr as $f) {
                    $new_file_name .= $f;
                }
                $new_file_name .= '-' . date('Y-m-d-h:m:s') . '.' . $type;
                move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $new_file_name);
                $ret['src'] = $new_file_name;
                $ret['type'] = $type;
            }
            if (!empty($ret)) {
                ProjectAttachments::SaveAttachment($_POST['project_id'], $new_file_name, $type);
                echo json_encode($ret);
            } else {
                echo $error;
            }
        }
    }
}
