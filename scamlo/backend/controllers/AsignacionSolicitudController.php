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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->user->identity->id,Yii::$app->user->identity->role_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex2()
    {
        $searchModel = new AsignacionSolicitudSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,Yii::$app->user->identity->id,Yii::$app->user->identity->role_id);

        return $this->render('index2', [
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
            Yii::$app->session->setFlash('success', Icon::show('check').'Se ha creado una nueva tarea con exito.');
            return $this->redirect(['index', 'id' => $model->asignacion_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionCrear($submit = false)
    {
        $model = new AsignacionSolicitud();
        $searchModel = new SolicitudSearch();
        $guardo=false;
        $dataProvider = $searchModel->searchParaAsignacionTrabajadores(Yii::$app->request->queryParams);

       
        /*if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            
            return ActiveForm::validate($model);
        }*/
        

        if ($model->load(Yii::$app->request->post())) {
            
               if($this->verificarTrabajadorTarea($model->solicitud_id,$model->usuario_id)==0){
                  $guardo= $model->save();
               }else{
                     //return  ['usuario_id', 'message' => 'Este trabajador ya se le asigno esta tarea'];
                     // $this->renderAjax('crear', ['message' => 'Este trabajador ya se le asigno esta tarea']);
                       Yii::$app->session->setFlash('error', Icon::show('ban').'No se puede asignar la misma tarea al mismo trabajador.');
                       return $this->redirect(['create', 'id' =>-1]);
                   //  return $this->addError(usuario_id, 'El token debe contener letras y dígitos.');
                   
               }
                if ($guardo){
                    Yii::$app->session->setFlash('success', Icon::show('check').'Se ha creado una nueva tarea con exito.');
                    return $this->redirect(['view', 'id' => $model->asignacion_id]);
                } else {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }  
        }

        return $this->renderAjax('crear', [
            'model' => $model,
            ]);
    } 
    
    public function verificarTrabajadorTarea($solicitud_id,$usuario_id)
    {
    	 $result = Yii::$app->db->createCommand("select * from asignacion_solicitud  where solicitud_id=$solicitud_id and usuario_id=$usuario_id")->execute();
         return $result;
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
    public function actionUpdate($id,$submit = false)
    {                 
        
        $model = $this->findModel($id);  
            
        /* if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $submit == false) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $this->actualizarEstadoDeSolicitud($model->solicitud_id,$model->estado_id);
          
           // $solicitud_id=$model->solicitud_id;
           // $estado_id=$model->estado_id;
          	
            Yii::$app->session->setFlash('success', Icon::show('check').'Tarea actualizada.'.$model->solicitud_id." - ".$model->estado_id);
           
            return $this->redirect(['view', 'id' => $model->asignacion_id]);
        } else {
                if (Yii::$app->user->identity->role_id==40) {
                    return $this->renderAjax('update', [
                        'model' => $model,
                    ]);
                }else{
                     return $this->renderAjax('update2', [
                        'model' => $model,
                    ]);
                }
        }
    }
        
        public function actualizarEstadoDeSolicitud($solicitud_id,$estado_id)
    	{
    	  Yii::$app->db->createCommand("UPDATE solicitud set estado_id=$estado_id where id=$solicitud_id")->execute();
    		
        }

    /**
     * Deletes an existing AsignacionSolicitud model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {        

        $model= $this->findModel($id);
        try {
             $model->delete();
             Yii::$app->session->setFlash('success', Icon::show('check').'Tarea eliminada.');
        } catch(IntegrityException $e) {
            Yii::$app->session->setFlash('error', 'No es posible eliminar la asignacion de tarea.');
        }

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

    public function actionReport() {
 
        $table = new AsignacionSolicitud;
       // $model = $table->find()->where(['estado_id'=>'3'])->all();
        $model = $table->find()->all();

        $content = $this->renderPartial('_reportView', ['model' => $model,]);
         
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content, 
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=>['Realizado por: '.Yii::$app->user->identity->nombre_completo.' en: '.date("F j, Y")],
                //'SetFooter'=>[Html::img('@web/images/zzz.jpg')],
                'SetFooter'=>['Sede Yumbo 
                                : yumbo@univalle.edu.co Tel: +57 2 6699323 
                                Calle 3N 2N-17 Barrio las vegas
                                Universidad del Valle
                                Yumbo, Colombia
                                ©2017'],
            ]
        ]);
 
        // http response
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
 
        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}
