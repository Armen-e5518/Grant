<?php
namespace frontend\controllers;


use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Form Controller
 */
class MembersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'update',
                    'delete',
                    'clone',
                    'send-mail',
                    'view'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect('/site/login');
        }
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'members' => User::GetAllUsers(),
        ]);
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();

        }
        return $this->render('update', [
            'id' => $id,
        ]);
    }

}
