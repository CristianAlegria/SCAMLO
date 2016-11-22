<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dependencia".
 *
 * @property integer $id
 * @property string $nombre_dependencia
 */
class Dependencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dependencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_dependencia'], 'required'],
            [['nombre_dependencia'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_dependencia' => 'Nombre Dependencia',
        ];
    }
}
