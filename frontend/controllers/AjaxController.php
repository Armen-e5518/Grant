<?php

namespace frontend\controllers;


use frontend\models\ProjectAttachments;
use frontend\models\ProjectFavorite;
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
}
