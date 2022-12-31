<?php

namespace app\controllers;

use app\models\Letters;
use app\models\LettersForAttach;
use Yii;
use app\models\Users;
use app\models\UsersForImages;
use app\models\UsersSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Users();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
            }
        }
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (\Yii::$app->request->isAjax) {

            return $this->renderAjax('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model' => $model
            ]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }




    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->UsersID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
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
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionAddSignature()
    {

        $UsersID = Yii::$app->request->post('id');
        $session = Yii::$app->session;

        if ($UsersID != null) {
            $session->set('UsersIDSignature', $UsersID);
        }
        $model = UsersForImages::findOne(['UsersID' => $session->get('UsersIDSignature')]);

        if ($model->UsersSignature == null) {
            if ($model->load(Yii::$app->request->post())) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                if (!empty($model->imageFile) && $model->validate()) {
                    $fileName = sha1(time() . $model->imageFile->baseName);
                    $model->imageFile->saveAs('web/users_picture/' . $fileName . '.' . $model->imageFile->extension);
                    $model->UsersSignature = $fileName . '.' . $model->imageFile->extension;
                    $model->imageFile = '';
                    $model->save(false);

                    return '<div></div>';
                }
            } else {
                return $this->renderAjax('addSignature', [
                    'model' => $model,
                ]);
            }
        } else {
            return '<div class="text-center" style="color : red;font-size : 12px;">این کاربر از قبل امضا دارد</div>';
        }
    }
    // public function actionDeleteSignature()
    // {

    //     $LetterID = Yii::$app->request->post('id');
    //     $FindLetter = Letters::findOne(['LettersID' => $LetterID]);
    //     if ($FindLetter) {
    //         if ($FindLetter->LettersAttachmentType == 2) {
    //             $File = Yii::getAlias('@webroot') . '/web/uploadAttachment/' . $FindLetter->LettersAttachmentUrl;
    //             if (file_exists($File)) {
    //                 $FindLetter->LettersAttachmentType = 1;
    //                 $FindLetter->LettersAttachmentUrl = '';
    //                 $FindLetter->LettersAttachmentFileName = '';
    //                 $FindLetter->update();
    //                 unlink($File);


    //                 $a = array('del_attach' => 'ok');
    //                 return Json::encode($a);
    //             } else {
    //                 $FindLetter->LettersAttachmentType = 1;
    //                 $FindLetter->LettersAttachmentUrl = '';
    //                 $FindLetter->LettersAttachmentFileName = '';
    //                 $FindLetter->update();
    //                 $a = array('del_attach' => 'ok');
    //                 return Json::encode($a);
    //             }
    //         } else {
    //             $a = array('del_attach' => 'no');
    //             return Json::encode($a);
    //         }
    //     } else {
    //         $a = array('del_attach' => 'no-file');
    //         return Json::encode($a);
    //     }
    // }
}