<?php

namespace backend\controllers;

use Yii;
use backend\models\AsignacionSolicitud;
use backend\models\search\AsignacionSolicitudSearch;
use backend\models\Solicitud;
use common\models\User;
use backend\models\search\SolicitudSearch;
use backend\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\icons\Icon;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use kartik\mpdf\Pdf;
use common\models\ValueHelpers;

/**
 * AsignacionSolicitudController implements the CRUD actions for AsignacionSolicitud model.
 */
class AsignacionSolicitudController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AsignacionSolicitud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsignacionSolicitudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AsignacionSolicitud model.
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
     * Creates a new AsignacionSolicitud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($submit = false)
    {
        $model = new AsignacionSolicitud();
        $searchModel = new SolicitudSearch();
        $dataProvider = $searchModel->searchParaAsignacionTrabajadores(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asignacion_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    public function actionDisponibilidad()
    {
        $model = new AsignacionSolicitud();
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->searchParaAsignacionTrabajadores_tablaTrabajadores(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asignacion_id]);
        } else {
            return $this->renderAjax('disponibilidad', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Updates an existing AsignacionSolicitud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->asignacion_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AsignacionSolicitud model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AsignacionSolicitud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AsignacionSolicitud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AsignacionSolicitud::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
