<?php

namespace frontend\controllers;

use frontend\models\Companies;
use frontend\models\Countries;
use frontend\models\RulesName;
use frontend\models\UserRules;
use Yii;
use frontend\models\User;
use frontend\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {

        if (!Yii::$app->rule_check->CheckByKay(['members_menage'])) {
            $this->redirect('/');
        }
        return parent::beforeAction($action);
    }


    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->redirect('index');
        $user_rules = UserRules::GetUserRulesNamesByUserId($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'user_rules' => $user_rules
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $rules = RulesName::GetRules();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $name = $model->upload();
            if (!empty($name)) {
                $model->image_url = (string)$name;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $id = $model->SaveUser();
            if (!empty($id) && UserRules::SaveRulesByUserId(Yii::$app->request->post('rules'), $id)) {
                return $this->redirect(['update', 'id' => $id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'rules' => $rules,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $rules = RulesName::GetRules();
        $user_rules = UserRules::GetUserRulesByUserId($id);
        $countries = Countries::GetCountries();
        $companies = Companies::GetCompanies();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $name = $model->upload();
            if (!empty($name)) {
                $model->image_url = (string)$name;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $id = $model->UpdateUser($id);
            if (!empty($id) && UserRules::SaveRulesByUserId(Yii::$app->request->post('rules'), $id)) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'rules' => $rules,
            'user_rules' => $user_rules,
            'countries' => $countries,
            'companies' => $companies,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
