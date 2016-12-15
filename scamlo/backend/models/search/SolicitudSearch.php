<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Solicitud;

/**
 * SolicitudSearch represents the model behind the search form about `backend\models\Solicitud`.
 */
class SolicitudSearch extends Solicitud
{
     public $globalSearch;
     
    /**
     * @inheritdoc
     */   

    public function rules()
    {
        return [
            [['id','numero_piso', 'user_id', 'estado_id'], 'integer'],
            [['description', 'fecha',  'dependencia_id', 'servicio_id','espacio_id','descripcion_otros', 'globalSearch','descripcion_estado'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'globalSearch' => "Buscar",
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Solicitud::find();

        // add conditions that should always apply here

         $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('dependencia');
        $query->joinWith('servicio');
        $query->joinWith('espacio');


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,            
            'numero_piso' => $this->numero_piso,
            'user_id' => $this->user_id,
            'estado_id' => $this->estado_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'dependencia.nombre_dependencia', $this->dependencia_id])
            ->andFilterWhere(['like', 'servicio.nombre_servicio', $this->servicio_id])
            ->andFilterWhere(['like', 'espacio.nombre', $this->espacio_id])
            ->andFilterWhere(['like', 'descripcion_otros', $this->descripcion_otros])
            ->andFilterWhere(['like', 'fecha', $this->fecha])
            ->andFilterWhere(['like', 'descripcion_estado', $this->descripcion_estado]); 
        return $dataProvider;
    }

    public function searchParaAsignacionTrabajadores($params)
    {
        $query = Solicitud::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->joinWith('dependencia');
        $query->joinWith('servicio');
        $query->joinWith('espacio');
        $query->joinWith('estado');

        $query->orFilterWhere(['like', 'id', $this->globalSearch])
            ->orFilterWhere(['like', 'dependencia.nombre_dependencia', $this->globalSearch])
            ->orFilterWhere(['like', 'servicio.nombre_servicio', $this->globalSearch])
            ->orFilterWhere(['like', 'description', $this->globalSearch])
            ->orFilterWhere(['like', 'espacio.nombre', $this->globalSearch])
            ->orFilterWhere(['like', 'descripcion_otros', $this->globalSearch])
            ->orFilterWhere(['like', 'numero_piso', $this->globalSearch])
            ->orFilterWhere(['like', 'fecha', $this->globalSearch])
            ->orFilterWhere(['like', 'user.nombre_completo', $this->globalSearch])
            ->orFilterWhere(['like', 'estado.nombre', $this->globalSearch])
            ->orFilterWhere(['like', 'espacio_id', $this->globalSearch])
            ->orFilterWhere(['like', 'descripcion_estado', $this->globalSearch]);            

        return $dataProvider;
    }
}
