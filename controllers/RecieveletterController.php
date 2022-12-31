<?php

namespace app\controllers;

use app\models\Letters;
use app\models\Letterstrash;
use app\models\Referralletters;
use app\models\Sendletters;
use app\models\Users;
use Yii;
use app\models\VwRecieveletter;
use app\models\VwRecieveletterSearch;
use hoomanMirghasemi\jdf\Jdf;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RecieveletterController implements the CRUD actions for VwRecieveletter model.
 */
class RecieveletterController extends Controller
{
    public $LetterResponseID;
    public $LetterNumber;
    public $LetterSender;


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
        $searchModel = new VwRecieveletterSearch();

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
        $FindLetter = VwRecieveletter::findOne(['LettersID' => $LetterID, 'UsersID_Reciever' => $userId]);

        $updateLetter = Sendletters::findOne(['LettersID_FK' => $LetterID, 'UsersID_FK' => $userId]);

        if ($FindLetter &&  $updateLetter->SendLettersReadType == 1) {

            $updateLetter->SendLettersReadType = 2;
            $updateLetter->update();
            return $this->renderAjax('show_letter', [
                'model' => $FindLetter,
            ]);
        } elseif ($FindLetter &&  $updateLetter->SendLettersReadType == 2) {
            return $this->renderAjax('show_letter', [
                'model' => $FindLetter,
            ]);
        }
    }
    public function actionSendAnswer()
    {
        $LettersTransation = Letters::getDb()->beginTransaction();
        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');


        try {
            if ($LetterID) {

                $FindLetter = VwRecieveletter::findOne(['LettersID' => $LetterID, 'UsersID_Reciever' => $userId]);
                $findResponse = Letters::findOne(['LettersResponseID' => $LetterID]);

                if ($findResponse) {
                    return '<h5 class="text-danger text-center">برای این نامه از قبل پاسخی ارسال شده یا پیش نویسی تهیه شده است</h5>';
                }


                $this->LetterResponseID = $LetterID;
                $this->LetterNumber = $FindLetter->LettersNumber;
                $this->LetterSender = $FindLetter->FullNameSender;
            }

            $model = new Letters();
            if ($model->load(Yii::$app->request->post())) {

                $model->LettersCreateDate = Jdf::jdate('Y/m/d H:i:s');
                $model->LettersNumber = time() . '';
                $model->LettersDraftType = 1;
                $model->LettersType = 2;
                $model->LettersAttachmentType = 1;
                $model->LettersAttachmentUrl = '';
                $model->LettersAttachmentFileName = '';
                $model->LettersArchiveType = 1;
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                $model->UsersID_FK = Yii::$app->user->id;
                if (!empty($model->imageFile)) {
                    $fileName = sha1(time() . $model->imageFile->baseName);
                    $model->imageFile->saveAs('web/uploadAttachment/' . $fileName . '.' . $model->imageFile->extension);
                    $model->LettersAttachmentType = 2;
                    $model->LettersAttachmentUrl = $fileName . '.' . $model->imageFile->extension;
                    $model->LettersAttachmentFileName = $model->imageFile->baseName . '.' . $model->imageFile->extension;
                }

                if ($model->save()) {
                    $LettersTransation->commit();
                }
            }
            return $this->renderAjax('answer', [
                'model' => $model,
                'LetterResponseID' => $this->LetterResponseID,
                'LetterNumber' => $this->LetterNumber,
                'LetterSender' => $this->LetterSender
            ]);
        } catch (\Exception $error) {
            $LettersTransation->rollBack();
            throw $error;
        }
    }

    public function actionDeleting()
    {
        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');
        $FindLetter = Sendletters::findOne(['UsersID_FK' => $userId, 'LettersID_FK' => $LetterID]);
        if ($FindLetter) {
            $model = new Letterstrash();
            $model->UsersID_FK = $userId;
            $model->LettersID_FK = $LetterID;
            $model->LettersTrashDate = Jdf::jdate('Y/m/d H:i:s');
            $model->save();
            $FindLetter->delete();
        }
    }
    public function actionDownloadFile($id)
    {
        $FindLetter = Letters::findOne(['LettersID' => $id]);
        if ($FindLetter && $FindLetter->LettersAttachmentType == 2) {
            $File = Yii::getAlias('@webroot') . '/web/uploadAttachment/' . $FindLetter->LettersAttachmentUrl;
            if (file_exists($File)) {
                Yii::$app->response->sendFile($File);
            }
        } else {
            throw new NotFoundHttpException('خطا در انجام عملیات');
        }
    }
    public function actionLunchReferral()
    {
        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');
        $model = new Referralletters();

        $FindUsers = Users::find()->select(['UsersID', 'UsersName', 'UsersFamily'])->where(['NOT IN', 'usersID', $userId])->all();
        $Users = [];
        foreach ($FindUsers as $key => $value) {
            $Users[$value->UsersID] = $value->UsersName . ' ' . $value->UsersFamily;
        }

        return $this->renderAjax('referral', [
            'model' => $model,
            'Users' => $Users,
            'LetterID' => $LetterID,
            'userId' => $userId
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