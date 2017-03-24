<?php

namespace backend\models;

use Yii;
use common\models\User;
use backend\models\Estado;
use backend\models\Espacio;
use backend\models\TipoEspacio;
use backend\models\Dependencia;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "solicitud".
 *
 * @property string $id
 * @property integer $dependencia_id
 * @property integer $servicio_id
 * @property string $description
 * @property integer $espacio_id
 * @property integer $numero_piso
 * @property string $fecha
 * @property integer $user_id
 * @property integer $estado_id
 * @property string $descripcion_estado
 *
 * @property Espacio $espacio
 * @property Estado $estado
 * @property Servicio $servicio
 * @property User $user
 * @property Dependencia $dependencia
 */
class Solicitud extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'solicitud';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'numero_piso', 'fecha','espacio_id','dependencia_id','servicio_id'], 'required'],
            [['numero_piso', 'user_id', 'estado_id'], 'integer'],
            [['description', 'descripcion_otros', 'descripcion_estado'], 'string', 'max' => 255],
            [['fecha'], 'string', 'max' => 48],
            [['espacio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Espacio::className(), 'targetAttribute' => ['espacio_id' => 'espacio_id']],
            [['estado_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['estado_id' => 'id']],
            [['servicio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servicio::className(), 'targetAttribute' => ['servicio_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['user_id', 'default', 'value' => Yii::$app->user->identity->id],
            [['dependencia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dependencia::className(), 'targetAttribute' => ['dependencia_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'No. de solicitud'),
            'dependencia_id' => Yii::t('app','Dependencia'),
            'servicio_id' => Yii::t('app','Servicio'),
            'description' => Yii::t('app','Descripcion'),
            'descripcion_otros' => Yii::t('app','Descripcion de otro Espacio'),
            'espacio_id' => Yii::t('app','Espacio'),
            'numero_piso' => Yii::t('app','Numero Piso'),
            'fecha' => Yii::t('app','Fecha solicitud'),
            'user_id' => Yii::t('app', 'Solicitante'),
            'nombreUser' => Yii::t('app', 'Solicitante'),
            'estado_id' => Yii::t('app','Estado'),
            'nombreEstado' => Yii::t('app', 'Estado de solicitud'),
            'nombreEspacio' => Yii::t('app', 'Espacio'),
            'nombreDependencia' => Yii::t('app', 'Dependencia'),
            'nombreServicio' => Yii::t('app', 'Servicio'),
            'descripcion_estado' => Yii::t('app','Descripcion Estado'),
            'codigoEspacio' => Yii::t('app', 'Numero de espacio'),
            'nombreEdificio' => Yii::t('app', 'Edificio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspacio()
    {
        return $this->hasOne(Espacio::className(), ['espacio_id' => 'espacio_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'estado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio()
    {
        return $this->hasOne(Servicio::className(), ['id' => 'servicio_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependencia()
    {
        return $this->hasOne(Dependencia::className(), ['id' => 'dependencia_id']);
    }

             /**
    * get list of Dependencia for dropdown
    */
    public static function getDependenciaList()
    {
        $droptions = Dependencia::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'id', 'nombre_dependencia');
    }

              /**
    * get list of Servicio for dropdown
    */
    public static function getServicioList()
    {
        $droptions = Servicio::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'id', 'nombre_servicio');
    }

              /**
    * get list of Espacio for dropdown
    */
    public static function getEspacioList()
    {       
           $query = (new yii\db\Query);
           $droptions =  $query->select(['espacio.codigo', 'espacio.espacio_id', 'espacio.nombre','edificio.nombre_edificio','edificio.edificio_id']) ->from('espacio')
                            ->leftJoin('edificio', 'edificio.edificio_id = espacio.edificio_id');
           $command = $query->createCommand();
           // Ejecutar el comando:
           $rows = $command->queryAll();
         return Arrayhelper::map($rows, 'espacio_id', 'codigo','nombre_edificio');        
    }

    /**
    * get edificio name
    *
    */
    public function getNombreDependencia()
    {
        return $this->dependencia ? $this->dependencia->nombre_dependencia : '- sin dependencia -';
    }
    public function getNombreServicio()
    {
        return $this->servicio ? $this->servicio->nombre_servicio : '- sin servicio -';
    }
    public function getNombreEspacio()
    {
        return $this->espacio ? $this->espacio->nombre: '- sin espacio -';
    }

    public function getNombreUser()
    {
        return $this->user ? $this->user->nombre_completo : '- sin nombre -';
    }

    public function getNombreEstado()
    {
        return $this->estado ? $this->estado->nombre : '- sin estado -';
    }

    public function getCodigoEspacio()
    {
        return $this->espacio ? $this->espacio->codigo : '- sin codigo -';
    }

    /*Consulta hecha por nosotros nosotros*/
    
    public  function getNombreEdificio()
    {
        $espacio_id =  $this->espacio_id;
        $connection = \Yii::$app->db;        
        $sql = " SELECT nombre_edificio FROM edificio WHERE edificio_id=(SELECT edificio_id FROM espacio WHERE espacio_id =:espacio_id)";
        $command = $connection->createCommand($sql);
        $command->bindValue(":espacio_id", $espacio_id);
        $result = $command->queryOne();
        return $result['nombre_edificio'];
    }
   public function getId()
    {
        return $this->getPrimaryKey();
    }

}
