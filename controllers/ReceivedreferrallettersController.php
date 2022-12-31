<?php

namespace app\controllers;

use Yii;
use app\models\VwReferralletters;
use app\models\ReceivedReferrallettersSearch;
use app\models\Referralletters;
use app\models\Sendletters;
use app\models\Users;
use app\models\VwRecieveletter;
use hoomanMirghasemi\jdf\Jdf;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReceivedreferrallettersController implements the CRUD actions for VwReferralletters model.
 */
class ReceivedreferrallettersController extends Controller
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
     * Lists all VwReferralletters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReceivedReferrallettersSearch();
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
     * Displays a single VwReferralletters model.
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
     * Creates a new VwReferralletters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VwReferralletters();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ReferralLettersID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VwReferralletters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ReferralLettersID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VwReferralletters model.
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
     * Finds the VwReferralletters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VwReferralletters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VwReferralletters::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionShowLetter()
    {

        $userId = Yii::$app->user->id;
        $ReferralLettersID = Yii::$app->request->post('id');
        $FindLetter = VwReferralletters::findOne(['ReferralLettersID' => $ReferralLettersID, 'UsersID_Receiver' => $userId]);

        if ($FindLetter->ReferralLettersReadType == 1) {
            $update = Referralletters::findOne(['ReferralLettersID' => $ReferralLettersID, 'UsersID_Receiver' => $userId]);
            $update->ReferralLettersReadType = 2;
            $update->update();
        }

        return $this->renderAjax('show_letter', [
            'model' => $FindLetter,
        ]);
    }
    public function actionLunchReferral()
    {
        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');
        $ReferralLettersID = Yii::$app->request->post('referral');

        $model = new Referralletters();
        $FindReferralinfo = VwReferralletters::findOne(['LettersID' => $LetterID, 'UsersID_Receiver' => $userId]);
        $creator = $FindReferralinfo->FullCreator;
        $referraler = $FindReferralinfo->FullNameSender;
        $LetterNumber = $FindReferralinfo->LettersNumber;
        $FindUsers = Users::find()->select(['UsersID', 'UsersName', 'UsersFamily'])->where(['NOT IN', 'usersID', $userId])->all();
        $Users = [];
        foreach ($FindUsers as $key => $value) {
            $Users[$value->UsersID] = $value->UsersName . ' ' . $value->UsersFamily;
        }

        return $this->renderAjax('referral', [
            'model' => $model,
            'Users' => $Users,
            'LetterID' => $LetterID,
            'userId' => $userId,
            'referraler' => $referraler,
            'creator' => $creator,
            'LetterNumber' => $LetterNumber
        ]);
    }
    public function actionSendReferral()
    {
        $userId = Yii::$app->user->id;
        $ReferralTransaction = Referralletters::getDb()->beginTransaction();
        try {

            $model = new Referralletters();
            if ($model->load(Yii::$app->request->post())) {

                $FindUsers = Users::find()->select(['UsersID'])->where(['IN', 'UsersID', $model->UsersID_Receiver])->all();
                if ($FindUsers) {
                    foreach ($FindUsers as $key => $value) {
                        $inserting = new Referralletters();
                        $inserting->UsersID_Receiver = $value->UsersID;
                        $inserting->ReferralLettersDescription = $model->ReferralLettersDescription;
                        $inserting->LettersID_FK = $model->LettersID_FK;
                        $inserting->UsersID_Sender = $model->UsersID_Sender;
                        $inserting->ReferralLettersDate = Jdf::jdate('Y/m/d H:i:s');
                        $inserting->ReferralLettersReadType = 1;
                        $inserting->save();
                    }
                    $ReferralTransaction->commit();
                } else {
                    return '<h5 class="text-center text-danger">این نامه برای این کاربر قبلا ارجاع داده شده است</h5>';
                }
            }
        } catch (\Exception $e) {
            $ReferralTransaction->rollBack();
            throw new NotFoundHttpException('خطا در انجام عملیات');
        }
    }
}