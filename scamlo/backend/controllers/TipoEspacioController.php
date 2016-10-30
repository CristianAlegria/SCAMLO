<?php

namespace backend\controllers;

use Yii;
use backend\models\TipoEspacio;
use backend\models\search\TipoEspacioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermissionHelpers;
use yii\web\Response;
use yii\widgets\ActiveForm;
use \yii\db\IntegrityException;
use kartik\icons\Icon;

/**
 * TipoEspacioController implements the CRUD actions for TipoEspacio model.
 */
class TipoEspacioController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'access' => [
        'class' => \yii\filters\AccessControl::className(),
        'only' => ['index', 'view','create', 'update', 'delete'],
        'rules' => [
        [
        'actions' => ['index', 'view', 'create', 'update', 'delete'],
        'allow' => true,
        'roles' => ['@'],
        'matchCallback' => function ($rule, $action) {

            return PermissionHelpers::requireMinimumRole('Administrador')
            && PermissionHelpers::requireStatus('Activo');
        }
        ],
        [
        'actions' => [ 'index', 'view', 'create', 'update'],
        'allow' => true,
        'roles' => ['@'],
        'matchCallback' => function ($rule, $action) {
            return PermissionHelpers::requireMinimumRole('Auxiliar')
            && PermissionHelpers::requireStatus('Activo');
        }
        ],
        [
        'actions' => ['nada'],
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
     * Lists all TipoEspacio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoEspacioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoEspacio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TipoEspacio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($submit = false)
    {
        $model = new TipoEspacio();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Icon::show('check').'Se ha creado un nuevo tipo de espacio.');
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
     * Updates an existing TipoEspacio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $submit = false)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Icon::show('check').'Tipo de espacio actualizado.');
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
     * Deletes an existing Equipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   
        $model= $this->findModel($id);
        try {
             $model->delete();
             Yii::$app->session->setFlash('success', Icon::show('check').'Tipo de espacio eliminado.');
        } catch(IntegrityException $e) {
            Yii::$app->session->setFlash('error', 'No es posible eliminar el tipo de espacio porque tiene una relacion con un espacio existente.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoEspacio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TipoEspacio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TipoEspacio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }
}
