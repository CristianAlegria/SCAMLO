<?php

namespace backend\models;

use Yii;
use common\models\User;
use backend\models\Estado;
use backend\models\Espacio;
use backend\models\Solicitud;
use yii\helpers\ArrayHelper;




/**
 * This is the model class for table "asignacion_solicitud".
 *
 * @property integer $asignacion_id
 * @property integer $solicitud_id
 * @property integer $estado_id
 * @property integer $usuario_id
 * @property string $fecha_hora_inicio
 * @property string $fecha_hora_fin
 * @property string $equipo_reparado
 * @property integer $numero_inventario
 * @property string $observaciones
 *
 * @property Estado $estado
 * @property Solicitud $solicitud
 * @property User $usuario
 */
class AsignacionSolicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    
    public static function tableName()
    {
        return 'asignacion_solicitud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'usuario_id', 'fecha_hora_inicio','estado_id'], 'required'],
            [['numero_inventario'], 'integer'],
            [['fecha_hora_inicio', 'fecha_hora_fin'], 'safe'],
            [['equipo_reparado'], 'string', 'max' => 80],
           // ['usuario_id', 'integer','max' => 12345600,'message'=> 'El trabajador seleccionado ya se le asigno esta tarea'],
            [['observaciones'], 'string', 'max' => 255],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_id' => 'id']],
            [['solicitud_id'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitud::className(), 'targetAttribute' => ['solicitud_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            ['usuario_id', 'default', 'value' => Yii::$app->user->identity->id],
        ];
    }

    /**
     * @inheritdoc
     */
     
    public function attributeLabels()
    {
        return [
            'asignacion_id' => 'Asignacion ID',
            'solicitud_id' => 'Solicitud',
            'espacio_id' => 'Espacio',
          
            'usuario_id' => 'Trabajador',
            'fecha_hora_inicio' => 'Fecha Hora Inicio',
            'fecha_hora_fin' => 'Fecha Hora Fin',
            'equipo_reparado' => 'Equipo Reparado',
            'numero_inventario' => 'Numero Inventario',
            'observaciones' => 'Observaciones',
            'nombreUser' => 'Trabajador Encargado',
            'nombreSolicitud' =>'Solicitud',
            
            
           
            'solicitudId'=>'No. de solicitud',
            'solicitante'=>'Solicitante',
            'nombreDependencia'=>'Dependencia',
            'nombreServicio'=>'Servicio',
            'description'=>'Descripción',
            'nombreEdificio'=>'Edificio',
            'nombreEspacio'=>'Espacio',
            'numeroEspacio'=>'Numero de espacio',
            'otroEspacio'=>'Descripcion de otro Espacio',
            'fecha'=>'Fecha solicitud',
            'nombreEstado' =>'Estado',
            
            
            
        ];
    }

   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'estado_id']);
    }

    public function getNombreEstado()
    {
        return $this->estado ? $this->estado->nombre : '- sin estado -';
    }
   
    

    /**
    * get list of Estados for dropdown
    */
    public static function getEstadoList()
    {
        $droptions = Estado::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'id', 'nombre');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitud()
    {
        return $this->hasOne(Solicitud::className(), ['id' => 'solicitud_id']);
    }

    public function getNombreSolicitud()
    {
        return $this->solicitud ? $this->solicitud->description : '- sin estado -';
    }
    
    
    
    

    public static function getSolicitudList()
    {
        $droptions = Solicitud::find()->where(['<>', 'estado_id', 1])->asArray()->all();
        return Arrayhelper::map($droptions, 'id', 'description');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }
    

    public function getNombreUser()
    {
        return $this->user ? $this->user->nombre_completo : '- sin nombre -';
    }

    public static function getUserList()
    {
        $role_id_constante = 20;
        $droptions = User::find()->orwhere(['role_id'=>$role_id_constante])->asArray()->all();
        return Arrayhelper::map($droptions, 'id', 'nombre_completo');
    }
    
    public static function getEspacioList()
    {       
        
           $query = (new yii\db\Query);
           $droptions =  $query->select(['solicitud.id as solicitud_id','user.nombre_completo as solicitante','dependencia.nombre_dependencia',
                                        'servicio.nombre_servicio','solicitud.description','edificio.nombre_edificio','espacio.nombre as nombre_espacio',
                                        'espacio.codigo as numero_espacio','solicitud.descripcion_otros as otro_espacio','solicitud.fecha',
                                        'estado.nombre as estado'])
                             ->from('asignacion_solicitud')
                            ->leftJoin('solicitud', 'solicitud.id = asignacion_solicitud.solicitud_id')
                            ->leftJoin('espacio', 'espacio.espacio_id = solicitud.espacio_id')
                            ->leftJoin('user', 'user.id =solicitud.user_id')
                            ->leftJoin('estado', 'estado.id =solicitud.estado_id')
                            ->leftJoin('edificio', 'edificio.edificio_id =espacio.edificio_id')
                            ->leftJoin('dependencia', 'dependencia.id =solicitud.dependencia_id')
                            ->leftJoin('servicio', 'servicio.id =solicitud.servicio_id');
                            
           $command = $query->createCommand();
           // Ejecutar el comando:
           $rows = $command->queryAll();
         return $rows;        
    }
    
    
    public function getSolicitudId(){return $this->espacioList[0]['solicitud_id'];}
    public function getSolicitante(){return $this->espacioList[0]['solicitante'];} 
    public function getNombreDependencia(){return $this->espacioList[0]['nombre_dependencia'];} 
    public function getNombreServicio(){return $this->espacioList[0]['nombre_servicio'];} 
    public function getDescription(){return $this->espacioList[0]['description'];} 
    public function getNombreEdificio(){return $this->espacioList[0]['nombre_edificio'];} 
    public function getNombreEspacio(){return $this->espacioList[0]['nombre_espacio'];} 
    public function getNumeroEspacio(){return $this->espacioList[0]['numero_espacio'];} 
    public function getOtroEspacio(){return $this->espacioList[0]['otro_espacio'];} 
    public function getFecha(){return $this->espacioList[0]['fecha'];} 
    
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
