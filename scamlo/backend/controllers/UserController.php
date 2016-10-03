<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use yii\web\Response;
use yii\widgets\ActiveForm;
use kartik\icons\Icon;
use yii\web\UploadedFile;
use backend\models\UploadForm;
use backend\models\Upload;
use \yii\db\IntegrityException;

/**
 * UserController implements the CRUD actions for User model.
 */

class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'access' => [
        'class' => \yii\filters\AccessControl::className(),
        'only' => ['index', 'view','create', 'update', 'delete', 'upload', 'mi-perfil', 'cambiar-clave'],
        'rules' => [
        [
        'actions' => ['index', 'view', 'create', 'update', 'delete', 'upload', 'mi-perfil', 'cambiar-clave'],
        'allow' => true,
        'roles' => ['@'],
        'matchCallback' => function ($rule, $action) {
            return PermissionHelpers::requireMinimumRole('Administrador')
            && PermissionHelpers::requireStatus('Activo');
        }
        ],
        [
        'actions' => [ 'index', 'view', 'create', 'update', 'upload', 'mi-perfil', 'cambiar-clave'],
        'allow' => true,
        'roles' => ['@'],
        'matchCallback' => function ($rule, $action) {
            return PermissionHelpers::requireMinimumRole('Auxiliar')
            && PermissionHelpers::requireStatus('Activo');
        }
        ],
        [
        'actions' => ['mi-perfil', 'cambiar-clave'],
        'allow' => true,
        'roles' => ['@'],
        'matchCallback' => function ($rule, $action) {
            return PermissionHelpers::requireMinimumRole('Estudiante')
            && PermissionHelpers::requireStatus('Activo');
        }
        ],
        ],
        ],
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
        'delete' => ['post'],
        ],
        ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate($submit = false)
    {
        $model = new User();
        $model->passwordNueva = 'nueva';
        $model->passwordConfirmada = 'nueva';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Icon::show('check').'Se ha creado un nuevo usuario.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
            ]);
    }

        /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionMiPerfil()
    {
        return $this->render('miPerfil', [
            'model' => $this->findModel(Yii::$app->user->identity->id),
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $submit = false)
    {
        $model = $this->findModel($id);
        $model->passwordNueva = 'nueva';
        $model->passwordConfirmada = 'nueva';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Icon::show('check').'Usuario actualizado.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->renderAjax('update', [
            'model' => $model,
            ]);
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        try {
             $model->delete();
             Yii::$app->session->setFlash('success', Icon::show('check').'Usuario eliminado.');
        } catch(IntegrityException $e) {
            Yii::$app->session->setFlash('error', 'No es posible eliminar el usuario porque ha realizado una o más solicitudes de reserva.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }

    public function actionUpload(){

        $model = new UploadForm();

        $objUpload = new Upload();

        if(Yii::$app->request->isPost){

             $model->excelFile = UploadedFile::getInstance($model,'excelFile');

             if($model->upload()){

                if($objUpload->uploadFileBD('uploads/'.$model->excelFile->name)){                   
                                       
                    Yii::$app->session->setFlash('success',Icon::show('check').'Archivo cargado con éxito, usuarios registrados.');
                    return $this->redirect(['index']);

                }else{

                    Yii::$app->session->setFlash('error', 'El archivo no tiene el formato deseado o hubo un error al cargar los datos a la BD.');
                    return $this->redirect(['index']);
                }

             }else{

                Yii::$app->session->setFlash('error', 'El archivo no pudo ser cargado porque ya existe un archivo con el mismo nombre.');
                return $this->redirect(['index']);
             }
                
        }
        return $this->renderAjax('upload',['model'=>$model]);         
    }

}
