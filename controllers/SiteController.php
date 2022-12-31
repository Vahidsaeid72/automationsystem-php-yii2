<?php

namespace app\controllers;

use app\models\Users;
use app\models\Usersaccess;
use app\models\VwLettersSearch;
use hoomanMirghasemi\jdf\Jdf;
use Mpdf\Mpdf;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
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
                    // 'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if (\Yii::$app->request->isAjax)
            return $this->renderAjax('index', []);
        return $this->render('index', []);
    }

    public function actionIndexAjax()
    {


        return $this->renderAjax('index', []);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'log';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUsersAccess()
    {
        $model = new Usersaccess();

        $FindUsers = Users::find()->select(['UsersID', 'UsersName', 'UsersFamily'])->all();
        $Users = [];
        foreach ($FindUsers as $key => $value) {
            $Users[$value->UsersID] = $value->UsersName . ' ' . $value->UsersFamily;
        }
        return $this->renderAjax('users_access', [
            'model' => $model,
            'Users' => $Users
        ]);
    }
    public function actionShowUsersAccess()
    {
        $model = new Usersaccess();
        if ($model->load(Yii::$app->request->post())) {
            $FindAccess = Usersaccess::findOne(['UsersID_FK' => $model->UsersID_FK]);
            $FindAccess->UsersAccess1 = $model->UsersAccess1;
            $FindAccess->UsersAccess2 = $model->UsersAccess2;
            $FindAccess->UsersAccess3 = $model->UsersAccess3;
            $FindAccess->UsersAccess4 = $model->UsersAccess4;
            $FindAccess->UsersAccess5 = $model->UsersAccess5;
            $FindAccess->UsersAccess6 = $model->UsersAccess6;
            $FindAccess->UsersAccess7 = $model->UsersAccess7;
            $FindAccess->UsersAccess8 = $model->UsersAccess8;
            $FindAccess->UsersAccess9 = $model->UsersAccess9;
            $FindAccess->UsersAccess10 = $model->UsersAccess10;
            $FindAccess->UsersAccess11 = $model->UsersAccess11;
            $FindAccess->UsersAccess12 = $model->UsersAccess12;
            $FindAccess->UsersAccess13 = $model->UsersAccess13;
            $FindAccess->UsersAccess14 = $model->UsersAccess14;
            $FindAccess->update();
        } else {
            $UID = Yii::$app->request->post('id');
            $model = Usersaccess::findOne(['UsersID_FK' => $UID]);

            $FindUsers = Users::find()->select(['UsersID', 'UsersName', 'UsersFamily'])->all();
            $Users = [];
            foreach ($FindUsers as $key => $value) {
                $Users[$value->UsersID] = $value->UsersName . ' ' . $value->UsersFamily;
            }
            return $this->renderAjax('users_access', [
                'model' => $model,
                'Users' => $Users
            ]);
        }
    }
}