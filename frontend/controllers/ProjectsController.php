<?php

namespace frontend\controllers;

use frontend\models\Countries;
use frontend\models\ProjectCountries;
use frontend\models\ProjectMembers;
use frontend\models\User;
use Yii;
use frontend\models\Projects;
use frontend\models\search\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
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

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();
        $members = User::GetUsers();
        $countries = Countries::GetCountries();
        if ($model->load(Yii::$app->request->post())
            && $model->save()
            && ProjectMembers::SaveMembersByProjectId($model->id, Yii::$app->request->post('members'))
            && ProjectCountries::SaveCountriesByProjectId($model->id, Yii::$app->request->post('countries'))
        ) {
            return $this->redirect(['/']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'members' => $members,
                'countries' => $countries,
            ]);
        }
    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $members = User::GetUsers();
        $select_members = ProjectMembers::GetMembersByProjectId($id);
        $countries = Countries::GetCountries();
        $select_countries = ProjectCountries::GetCountriesByProjectId($id);
        if ($model->load(Yii::$app->request->post())
            && $model->save()
            && ProjectMembers::SaveMembersByProjectId($model->id, Yii::$app->request->post('members'))
            && ProjectCountries::SaveCountriesByProjectId($model->id, Yii::$app->request->post('countries'))
        ) {
            return $this->redirect(['/']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'members' => $members,
                'select_members' => $select_members,
                'countries' => $countries,
                'select_countries' => $select_countries,
            ]);
        }
    }

    /**
     * Deletes an existing Projects model.
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
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}