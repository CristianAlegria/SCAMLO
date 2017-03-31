<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "edificio".
 *
 * @property integer $edificio_id
 * @property string $nombre_edificio
 * @property string $ubicacion
 *
 * @property Espacio[] $espacios
 */
class Edificio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'edificio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_edificio'], 'required'],
            [['nombre_edificio'], 'string', 'max' => 40, 'min' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'edificio_id' => 'Edificio Id',
            'nombre_edificio' => 'Nombre del Edificio',
            'ubicacion' => 'Ubicacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspacios()
    {
        return $this->hasMany(Espacio::className(), ['edificio_id' => 'edificio_id']);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
