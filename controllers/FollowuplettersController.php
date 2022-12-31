<?php

namespace app\controllers;

use Yii;
use app\models\VwRecieveletter;
use app\models\FollowUpLetters;
use app\models\Referralletters;
use app\models\RotationReferrallettersSearch;
use app\models\Sendletters;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FollowuplettersController implements the CRUD actions for VwRecieveletter model.
 */
class FollowuplettersController extends Controller
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
     * Lists all VwRecieveletter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FollowUpLetters();
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
     * Displays a single VwRecieveletter model.
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
     * Creates a new VwRecieveletter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VwRecieveletter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->LettersID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VwRecieveletter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->LettersID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VwRecieveletter model.
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
     * Finds the VwRecieveletter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VwRecieveletter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VwRecieveletter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionShowLetter()
    {
        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');
        $FindLetter = VwRecieveletter::findOne(['LettersID' => $LetterID, 'UsersID_FK' => $userId]);


        return $this->renderAjax('show_letter', [
            'model' => $FindLetter,
        ]);
    }
    public function actionLetterRotation()
    {

        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');
        $session = Yii::$app->session;
        $session->set('RotationLetterID', $LetterID);
        $FindLetter = VwRecieveletter::findOne(['LettersID' => $LetterID, 'UsersID_FK' => $userId]);

        $searchModel = new RotationReferrallettersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->renderAjax('letter_rotation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $FindLetter,
        ]);
    }
    public function actionShowDescription()
    {
        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');

        $FindReferralLetter = Referralletters::findOne(['ReferralLettersID' => $LetterID]);

        return $this->renderAjax('show_description', [

            'FindReferralLetter' => $FindReferralLetter,
        ]);
    }
}