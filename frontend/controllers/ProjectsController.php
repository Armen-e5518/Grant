<?php

namespace frontend\controllers;

use frontend\components\Helper;
use frontend\models\Companies;
use frontend\models\Countries;
use frontend\models\ProjectAttachments;
use frontend\models\ProjectCountries;
use frontend\models\ProjectMembers;
use frontend\models\User;

//use \PhpOffice\PhpWord\PhpWord;
//use PhpOffice\PhpWord;
use frontend\models\UserNotifications;
use PhpOffice\PhpWord\PhpWord;
use Yii;
use frontend\models\Projects;
use frontend\models\search\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
{


    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/index']);
            return false;
        }
        $action_id = Yii::$app->controller->action->id;
        if (Helper::CheckAction(
            [
                'create',
                'update',
                'delete-project',
                'delete',
                'index',
                'add-archive'
            ], $action_id)
        ) {
            if (!Yii::$app->rule_check->CheckByKay(['add_new_and_menage_prospects'])) {
                $this->redirect('/');
            }
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
//        echo '<pre>';
//        print_r(Helper::GetMonthAndYear(1990,2040));
//        exit;
        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWordTest()
    {

        // Creating the new document...
        $phpWord = new PhpWord();

//        /var/www/html/Grant/vendor/phpoffice/phpword/src/PhpWord/PhpWord.php
        /* Note: any element you append to a document must reside inside of a Section. */

// Adding an empty Section to the document...
        $section = $phpWord->addSection();
// Adding Text element to the Section having font styled by default...
        $section->addText(
            '"Learn from yesterday, live for today, hope for tomorrow. '
            . 'The important thing is not to stop questioning." '
            . '(Albert Einstein)'
        );

        /*
         * Note: it's possible to customize font style of the Text element you add in three ways:
         * - inline;
         * - using named font style (new font style object will be implicitly created);
         * - using explicitly created font style object.
         */

// Adding Text element with font customized inline...
        $section->addText(
            '"Great achievement is usually born of great sacrifice, '
            . 'and is never the result of selfishness." '
            . '(Napoleon Hill)',
            array('name' => 'Tahoma', 'size' => 10)
        );

// Adding Text element with font customized using named font style...
        $fontStyleName = 'oneUserDefinedStyle';
        $phpWord->addFontStyle(
            $fontStyleName,
            array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
        );
        $section->addText(
            '"The greatest accomplishment is not in never falling, '
            . 'but in rising again after you fall." '
            . '(Vince Lombardi)',
            $fontStyleName
        );

// Adding Text element with font customized using explicitly created font style object...
        $fontStyle = new \PhpOffice\PhpWord\Style\Font();
        $fontStyle->setBold(true);
        $fontStyle->setName('Tahoma');
        $fontStyle->setSize(13);
        $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
        $myTextElement->setFontStyle($fontStyle);

// Saving the document as OOXML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('words/helloWorld.docx');

    }

    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new Projects();
        $project = Projects::GetProjectDataById($id);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $tableStyle = array(
            'borderColor' => '000000',
            'borderSize' => 6,
        );
        $firstRowStyle = array('bgColor' => '000000');
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table = $section->addTable('myTable');

        $cellRowSpan = array('vMerge' => 'restart');
        $cellRowContinue = array('vMerge' => 'continue');
        $cellColSpan = array('gridSpan' => 2);

        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Assignment name:{$project['project_name']}");
        $table->addCell(5000, $cellRowSpan)->addText("Approx. value of the contract (in current US$ or Euro):{$project['project_value']}");
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Country:{$model->GetCountriesByProjectId($id)}");
        $table->addCell(5000, $cellRowSpan)->addText("Duration of assignment (months):{$project['duration_assignment']}");
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Location within country:{$project['location_within_country']}");
        $table->addCell(null, $cellRowContinue);
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Name of Client:{$project['client_name']}");
        $table->addCell(5000, $cellRowSpan)->addText("Total No. of staff-months of theassignment:{$project['staff_months']}");
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Address of Client:{$project['address_client']}");
        $table->addCell(5000, $cellRowSpan)->addText("Approx. value of the services provided bythe firm under the contract (in current US \$or Euro):{$project['services_value']}");
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Start date (month/year):{$project['start_date']}");
        $table->addCell(5000, $cellRowSpan)->addText("No. of professional staff-months provided by associated consultants:{$project['start_date']}");
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Completion date (month/year):{$project['completion_date']}");
        $table->addCell(null, $cellRowContinue);
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Role on the Assignment:{$model->GetAssignmentById($project['assignment_id'])}");
        $table->addCell(5000, $cellRowSpan)->addText("Proportion carried out by the firm, %:{$project['proportion']}");
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("Name of associated consultants, if any:{$project['consultants']}");
        $table->addCell(5000, $cellRowSpan)->addText("No. of professional staff-months provided by associated consultants:{$project['no_professional_staff']}");
        $table->addRow();
        $table->addCell(5000, $cellRowSpan)->addText("No of staff provided by the firm:{$project['no_provided_staff']}");
        $table->addCell(5000, $cellRowSpan)->addText(" ");
        $table->addRow();
        $table->addCell(10000, $cellColSpan)->addText("Narrative description of project:{$project['narrative_description']}");
        $table->addRow();
        $table->addCell(10000, $cellColSpan)->addText("Description of actual services provided by your staff within the assignment:{$project['actual_services_description']}");
        $table->addRow();
        $table->addCell(10000, $cellColSpan)->addText("Name of Firm:{$project['name_firm']}");

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $file = 'words/project_' . $project['project_name'] . '.docx';
        if (file_exists($file)) {
            unlink($file);
        }
        $objWriter->save($file);
        if (file_exists($file)) {
            return Yii::$app->response->SendFile($file);

        }
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $errors = true;
        $model = new Projects();
        $members = User::GetUsers();
        $countries = Countries::GetCountries();
        if (
            $model->load(Yii::$app->request->post())
            && $model->save()
            && ProjectMembers::SaveMembersByProjectId($model->id, Yii::$app->request->post('members'))
            && ProjectCountries::SaveCountriesByProjectId($model->id, Yii::$app->request->post('countries'), Yii::$app->request->post('international_status'))
        ) {
            if (Yii::$app->request->isPost) {
                $model->attachments = UploadedFile::getInstances($model, 'attachments');
                foreach ($model->attachments as $key => $file) {
                    $filename = preg_replace('/[^A-Za-z0-9 _ .-]/', '_', $file->baseName);
                    $filename = $filename . '.' . $file->extension;
                    if (!(
                        $file->saveAs('attachments/' . $filename)
                        && ProjectAttachments::SaveAttachment($model->id, $filename, $file->extension)
                    )
                    ) {
                        $errors = false;
                    };
                }
            }
            if ($errors && UserNotifications::NewNotificationsByUsers(Yii::$app->request->post('members'), $model->id, 1)) {

                return $this->redirect(['/']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'members' => $members,
            'countries' => $countries,
        ]);
    }

    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $errors = true;
        $model = $this->findModel($id);
        $members = User::GetUsers();
        $select_members = ProjectMembers::GetMembersByProjectId($id);
        $countries = Countries::GetCountries();
        $select_countries = ProjectCountries::GetCountriesByProjectId($id);
        if ($model->load(Yii::$app->request->post())
            && $model->save()
            && ProjectMembers::SaveMembersByProjectId($model->id, Yii::$app->request->post('members'))
            && ProjectCountries::SaveCountriesByProjectId($model->id, Yii::$app->request->post('countries'), $model->international_status)
        ) {
            if (Yii::$app->request->isPost) {
                $model->attachments = UploadedFile::getInstances($model, 'attachments');
                foreach ($model->attachments as $key => $file) {
                    $filename = preg_replace('/[^A-Za-z0-9 _ .-]/', '_', $file->baseName);
                    $filename = $filename . '-' . date('Y-m-d-h:m:s') . '.' . $file->extension;
                    if (!(
                        $file->saveAs('attachments/' . $filename)
                        && ProjectAttachments::SaveAttachment($model->id, $filename, $file->extension)
                    )
                    ) {
                        $errors = false;
                    };
                }
            }
            if ($errors && UserNotifications::NewNotificationsByUsers(Yii::$app->request->post('members'), $model->id, 1)) {

                return $this->redirect(['/']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'members' => $members,
            'select_members' => $select_members,
            'countries' => $countries,
            'select_countries' => $select_countries,
            'attachments' => ProjectAttachments::GetAttachmentsByProjectId($id),
        ]);

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
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDeleteProject($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/site']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public
    function actionAddArchive($id)
    {
        Projects::ChangeStatusToArchive($id);
        return $this->redirect(['/site']);
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
