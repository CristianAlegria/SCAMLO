<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "servicio".
 *
 * @property integer $id
 * @property string $nombre_servicio
 */
class Servicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_servicio'], 'required'],
            [['nombre_servicio'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_servicio' => 'Nombre Servicio',
        ];
    }
}
