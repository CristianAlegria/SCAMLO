<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tipo_espacio".
 *
 * @property integer $tipo_espacio_id
 * @property string $nombre_tipo
 *
 * @property Espacio[] $espacios
 */
class TipoEspacio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_espacio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_tipo'], 'required'],
            [['nombre_tipo'], 'string', 'max' => 40, 'min' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tipo_espacio_id' => 'Tipo de espacio Id',
            'nombre_tipo' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspacios()
    {
        return $this->hasMany(Espacio::className(), ['tipo_espacio_id' => 'tipo_espacio_id']);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
