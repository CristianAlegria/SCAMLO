<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\ContactForm;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Session;
use backend\models\FormRecoverPass;
use backend\models\FormResetPass;
use common\models\User;
use backend\models\RegistroForm;
use kartik\icons\Icon;
use backend\models\search\EspacioSearch;
use backend\models\Event;

/**
 * Site controller
 */
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get', 'post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();

        } else if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {

            return $this->goBack();

        } else {

            return $this->render('login', ['model' => $model,]);

        }

        
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionCambiarClave($submit = false)
    {
        $model = new User();
        $model = Yii::$app->user->identity;
 
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->passwordNueva);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Icon::show('check').'Se ha realizado el cambio de contraseña con éxito.');
                return $this->render('miPerfil', [
                    'model' => $this->findModel(Yii::$app->user->identity->id),
                ]);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('cambiar', [
            'model' => $model,
            ]);
    }
   
}
