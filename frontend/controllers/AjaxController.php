<?php

namespace frontend\controllers;


use frontend\models\ProjectAttachments;
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
class AjaxController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionGetParams()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return Yii::$app->params;
        }
    }

    public function actionDeleteAttachmentById()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            if (!empty($post)) {
                return ProjectAttachments::DeleteAttachmentById($post['id']);
            }
        }
    }

    public function actionAddOrDeleteFavorite()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            if (!empty($post)) {
                return ProjectFavorite::SaveOrDeleteFavorite($post['id']);
            }
        }
    }

    public function actionGetUserImage()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            if (!empty($post)) {
                return User::GetUserImage($post['id']);
            }
        }
    }

    public function actionGetProjectDataById()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            if (!empty($post)) {
                return Projects::GetProjectDataById($post['id']);
            }
        }
    }

    public function actionGetMembersDataByProjectId()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            if (!empty($post)) {
                return ProjectMembers::GetMembersByProjectIdAllData($post['id']);
            }
        }
    }

    public function actionGetAttachmentsByProjectId()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            if (!empty($post)) {
                return ProjectAttachments::GetAttachmentsByProjectId($post['id']);
            }
        }
    }
}
