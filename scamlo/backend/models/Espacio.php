<?php

namespace backend\models;

use Yii;
use backend\models\Edificio;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "espacio".
 *
 * @property integer $espacio_id
 * @property string $codigo
 * @property string $nombre
 * @property integer $capacidad
 * @property string $ubicacion
 * @property integer $edificio_id
 *
 * @property Edificio $edificio
 * @property TipoEspacio $tipoEspacio
 */
class Espacio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'espacio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'capacidad', 'nombre'], 'required'],
            [['capacidad', 'codigo'], 'integer','max' => 9999999999, 'min' => 001],
            [['ubicacion'], 'string', 'max' => 40, 'min' => 4],
            [['nombre'], 'string', 'max' => 40],
            [['codigo'], 'integer'],
            [['codigo'], 'unique'],
            [['edificio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Edificio::className(), 'targetAttribute' => ['edificio_id' => 'edificio_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nombre' => 'Nombre',
            'codigo' => 'Número de espacio',
            'espacio_id' => 'ID',
            'capacidad' => 'Capacidad',
            'ubicacion' => 'Ubicacion',
            'edificio_id' => 'Edificio',
            'nombreEdificio' => 'Edificio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEdificio()
    {
        return $this->hasOne(Edificio::className(), ['edificio_id' => 'edificio_id']);
    }

            /**
    * get list of Edificio for dropdown
    */
    public static function getEdificioList()
    {
        $droptions = Edificio::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'edificio_id', 'nombre_edificio');
    }

    /**
    * get edificio name
    *
    */

    public function getNombreEdificio()
    {
        return $this->edificio ? $this->edificio->nombre_edificio : '- sin edificio -';
    }


    /**
    * get list of tipoEspacio for dropdown
    */
    public static function getTipoEspacioList()
    {
        $droptions = TipoEspacio::find()->asArray()->all();
        return Arrayhelper::map($droptions, 'nombre_tipo', 'nombre_tipo');
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }


}
