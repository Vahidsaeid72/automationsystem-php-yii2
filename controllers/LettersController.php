<?php

namespace app\controllers;

use Yii;
use app\models\Letters;
use app\models\LettersForAttach;
use app\models\LettersSearch;
use app\models\Sendletters;
use app\models\Users;
use app\models\VwLettersSearch;
use Exception;
use hoomanMirghasemi\jdf\Jdf;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * LettersController implements the CRUD actions for Letters model.
 */
class LettersController extends Controller
{
    // public $LetterUpdatingID;

    function convertEnglishToPersian($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $output = str_replace($english, $persian, $string);
        return $output;
    }
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
     * Lists all Letters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VwLettersSearch();
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
     * Displays a single Letters model.
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
     * Creates a new Letters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Letters();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->LettersID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Letters model.
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
     * Deletes an existing Letters model.
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
     * Finds the Letters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Letters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Letters::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionLunchModal()
    {
        $LettersTransation = Letters::getDb()->beginTransaction();


        try {
            $model = new Letters();
            if ($model->load(Yii::$app->request->post())) {
                $model->LettersCreateDate = $this->convertEnglishToPersian(Jdf::jdate('Y/m/d H:i:s'));
                $model->LettersNumber = time() . '';
                $model->LettersDraftType = 1;
                $model->LettersType = 1;
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
                } else {
                    var_dump($model->errors);
                }
            }
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        } catch (\Exception $error) {
            $LettersTransation->rollBack();
            throw $error;
        }
    }
    public function actionCheckResponseDate()
    {
        $model = new Letters();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }
    }

    public function actionUpdating()
    {
        $LetterUpdatingID = Yii::$app->request->post('id');
        $session = Yii::$app->session;

        if ($LetterUpdatingID !== null) {
            $session->set('LetterUpdatingID', $LetterUpdatingID);
        }
        $model = Letters::findOne(['LettersID' => $session->get('LetterUpdatingID')]);


        if ($model->load(Yii::$app->request->post())) {
            $UpdatingLetter = Letters::findOne(['LettersID' => $session->get('LetterUpdatingID')]);
            $UpdatingLetter->LettersSubject = $model->LettersSubject;
            $UpdatingLetter->LettersAbstract = $model->LettersAbstract;
            $UpdatingLetter->LettersTypeOfAction = $model->LettersTypeOfAction;
            $UpdatingLetter->LettersSecurity = $model->LettersSecurity;
            $UpdatingLetter->LettersFollowType = $model->LettersFollowType;
            $UpdatingLetter->LettersResponseType = $model->LettersResponseType;
            $UpdatingLetter->LettersResponseDate = $model->LettersResponseDate;
            $UpdatingLetter->LettersText = $model->LettersText;

            $UpdatingLetter->update();
        } else {

            return $this->renderAjax('updating', [
                'model' => $model,
            ]);
        }
    }
    public function actionDeleting()
    {
        $LetterID = Yii::$app->request->post('id');
        $FindLetter = Letters::findOne(['LettersID' => $LetterID]);

        if ($FindLetter) {
            if ($FindLetter->LettersAttachmentType == 2) {
                $File = Yii::getAlias('@webroot') . '/web/uploadAttachment/' . $FindLetter->LettersAttachmentUrl;
                if (file_exists($File)) {
                    unlink($File);
                    $FindLetter->delete();
                } else {
                    $FindLetter->delete();
                }
            } else {
                $FindLetter->delete();
            }
        } else {
        }
    }
    public function actionAddAttach()
    {
        $LetterID = Yii::$app->request->post('id');
        $session = Yii::$app->session;

        if ($LetterID !== null) {
            $session->set('AddAttach', $LetterID);
        }
        $model = LettersForAttach::findOne(['LettersID' => $session->get('AddAttach')]);

        if ($model->LettersAttachmentType == 1) {
            if ($model->load(Yii::$app->request->post())) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if (!empty($model->imageFile)) {
                    $fileName = sha1(time() . $model->imageFile->baseName);
                    $model->imageFile->saveAs('web/uploadAttachment/' . $fileName . '.' . $model->imageFile->extension);
                    $model->LettersAttachmentType = 2;
                    $model->LettersAttachmentUrl = $fileName . '.' . $model->imageFile->extension;
                    $model->LettersAttachmentFileName = $model->imageFile->baseName . '.' . $model->imageFile->extension;
                    $model->save();
                    return true;
                }
            } else {
                return $this->renderAjax('add_attach', [
                    'model' => $model,
                ]);
            }
        } else {
            return '<div class="text-center" style="color : red;font-size : 12px;">این نامه از قبل پیوست دارد</div>';
        }
    }
    public function actionDeleteAttach()
    {

        $LetterID = Yii::$app->request->post('id');
        $FindLetter = Letters::findOne(['LettersID' => $LetterID]);
        if ($FindLetter) {
            if ($FindLetter->LettersAttachmentType == 2) {
                $File = Yii::getAlias('@webroot') . '/web/uploadAttachment/' . $FindLetter->LettersAttachmentUrl;
                if (file_exists($File)) {
                    $FindLetter->LettersAttachmentType = 1;
                    $FindLetter->LettersAttachmentUrl = '';
                    $FindLetter->LettersAttachmentFileName = '';
                    $FindLetter->update();
                    unlink($File);


                    $a = array('del_attach' => 'ok');
                    return Json::encode($a);
                } else {
                    $FindLetter->LettersAttachmentType = 1;
                    $FindLetter->LettersAttachmentUrl = '';
                    $FindLetter->LettersAttachmentFileName = '';
                    $FindLetter->update();
                    $a = array('del_attach' => 'ok');
                    return Json::encode($a);
                }
            } else {
                $a = array('del_attach' => 'no');
                return Json::encode($a);
            }
        } else {
            $a = array('del_attach' => 'no-file');
            return Json::encode($a);
        }
    }
    public function actionSending()
    {
        $model = new Sendletters();
        $LetterID = Yii::$app->request->post('id');
        $FindLetter = Letters::findOne(['LettersID' => $LetterID]);

        if ($FindLetter->LettersDraftType == 1) {
            $userId = Yii::$app->user->id;

            $FindUsers = Users::find()->select(['UsersID', 'UsersName', 'UsersFamily'])->where(['NOT IN', 'usersID', $userId])->all();
            $Users = [];
            foreach ($FindUsers as $key => $value) {
                $Users[$value->UsersID] = $value->UsersName . ' ' . $value->UsersFamily;
            }

            return $this->renderAjax('users', [
                'model' => $model,
                'Users' => $Users,
                'LetterID' => $LetterID
            ]);
        } else {
            return '<div class="text-center" style="color : red;font-size : 12px;">این نامه ارسال شده است </div>';
        }
    }
    public function actionSendingAnswer()
    {
        $userId = Yii::$app->user->id;
        $LetterID = Yii::$app->request->post('id');
        $LetterRID = Yii::$app->request->post('rid');

        $reciver = Yii::$app->db->createCommand("CALL SP_FindUsersForSendAnswer( $LetterRID )")->queryOne();


        $FindLetter = Letters::findOne(['LettersID' => $LetterID]);
        if ($FindLetter->LettersDraftType == 1) {
            $SendLetter = new Sendletters();
            $SendLetter->LettersID_FK = $LetterID;
            $SendLetter->UsersID_FK = $reciver['UsersID'];
            $SendLetter->SendLettersReadType = 1;
            $SendLetter->SendLettersDate = Jdf::jdate('Y/m/d H:i:s');
            $SendLetter->save();

            $FindLetter->LettersDraftType = 2;
            $FindLetter->update();
        }
    }
    public function actionSendForUsers()
    {

        $sendLetterTransaction = Sendletters::getDb()->beginTransaction();
        $LettersTransation = Letters::getDb()->beginTransaction();

        try {
            $model = new Sendletters();

            if ($model->load(Yii::$app->request->post())) {

                $FindUsers = Users::find()->select(['UsersID'])->where(['IN', 'UsersID', $model->UsersID_FK])->all();
                // $FindUsers = Users::find()->select(['UsersID'])->where(['IN', 'UsersID', $model->UsersID_FK])->createCommand()->getRawSql();

                foreach ($FindUsers as $key => $value) {
                    $sendLetter = new SendLetters();

                    $sendLetter->UsersID_FK = $value->UsersID;
                    $sendLetter->LettersID_FK = $model->LettersID_FK;
                    $sendLetter->SendLettersReadType = 1;
                    $sendLetter->SendLettersDate = Jdf::jdate('Y/m/d H:i:s');
                    $sendLetter->save();
                }
                $FindLetter = Letters::findOne(['LettersID' => $model->LettersID_FK]);
                $FindLetter->LettersDraftType = 2;
                $FindLetter->update();
                $sendLetterTransaction->commit();
                $LettersTransation->commit();
            }
        } catch (\Exception $error) {
            var_dump($error);
            $sendLetterTransaction->rollBack();
            $LettersTransation->rollBack();
            throw new NotFoundHttpException('خطا در انجام عملیات');
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
}