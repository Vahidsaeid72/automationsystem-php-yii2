<?php

namespace app\controllers;

use Yii;
use app\models\Jobs;
use app\models\Usersjob;
use app\models\JobsSearch;
use kartik\form\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm as WidgetsActiveForm;
use app\models\Users;
use app\models\VwUsersjobSearch;
use hoomanMirghasemi\jdf\Jdf;

/**
 * JobsController implements the CRUD actions for Jobs model.
 */
class JobsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete', 'index'],
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Jobs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JobsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (\Yii::$app->request->isAjax)
            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Jobs model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Jobs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jobs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->JobsID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Jobs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->JobsID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Jobs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Jobs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jobs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jobs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAddSubJob()
    {
        $model = new Jobs();

        if ($model->load(Yii::$app->request->post())) {
            $model->JobsStatus = 0;
            $model->save();
        } else {
            $jobID = Yii::$app->request->post('id');
            $FindJob = Jobs::findOne(['JobsID' => $jobID]);
            return $this->renderAjax('_form', [
                'model' => $model,
                'FindJob' => $FindJob
            ]);
        }
    }
    public function actionEditJob()
    {

        $jobID = Yii::$app->request->post('id');
        $session = Yii::$app->session;

        if ($jobID) {
            $session->set('JobID', $jobID);
        }
        $model = Jobs::findOne(['JobsID' => $session->get('JobID')]);

        if ($model->load(Yii::$app->request->post())) {
            $affterUpdat = Jobs::findOne(['JobsID' => $session->get('JobID')]);
            $affterUpdat->JobsName = $model->JobsName;
            $affterUpdat->JobsDescription = $model->JobsDescription;

            $affterUpdat->update();
        } else {
            $model = Jobs::findOne(['JobsID' => $session->get('JobID')]);
            return $this->renderAjax('updating', [
                'model' => $model,

            ]);
        }
    }
    public function actionCheck()
    {
        $model = new Jobs();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return WidgetsActiveForm::validate($model);
        }
    }
    public function actionUserJob()
    {

        $model = new Usersjob();

        if ($model->load(Yii::$app->request->post())) {
            $updateJob = Jobs::findOne(['JobsID' => $model->JobsID_FK]);

            if ($model->UsersJobStatus == 0) {
                $model->UsersJobStartDate = Jdf::jdate('Y/m/d H:i:s');
                $model->UsersJobStatus = 1;
                $model->save();

                $updateJob->JobsStatus = 1;
                $updateJob->update();
            }
        } else {
            $jobID = Yii::$app->request->post('id');


            $FindUsers = Users::find()->select(['UsersID', 'UsersName', 'UsersFamily'])->all();
            $Users = [];
            foreach ($FindUsers as $key => $value) {
                $Users[$value->UsersID] = $value->UsersName . ' ' . $value->UsersFamily;
            }

            return $this->renderAjax('user_job', [
                'model' => $model,
                'JobID' => $jobID,
                'Users' => $Users
            ]);
        }
    }
    public function actionEndJob()
    {
        $jobID = Yii::$app->request->post('id');
        $findUserJob = Usersjob::findOne(['JobsID_FK' => $jobID, 'UsersJobStatus' => 1]);
        $findJob = Jobs::findOne(['JobsID' => $jobID]);


        if ($findUserJob && $findJob->JobsStatus == 1) {

            $findUserJob->UsersJobEndDate = Jdf::jdate('Y/m/d H:i:s');
            $findUserJob->UsersJobStatus = 0;
            $findUserJob->update();

            $findJob->JobsStatus = 0;
            $findJob->update();
        }
    }

    public function actionJobRotation()
    {
        $jobID = Yii::$app->request->post('id');
        $session = Yii::$app->session;

        if ($jobID) {
            $session->set('JobRotationID', $jobID);
        }

        $searchModel = new VwUsersjobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderAjax('job_rotation', [

            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}