<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AsignacionSolicitud;

/**
 * AsignacionSolicitudSearch represents the model behind the search form about `backend\models\AsignacionSolicitud`.
 */
class AsignacionSolicitudSearch extends AsignacionSolicitud
{
    /**
     * @inheritdoc
     */

    public $globalSearch;
    public $role_id_constante = 40;

    public function rules()
    {
        return [
            [['asignacion_id', 'numero_inventario'], 'integer'],
            [['fecha_hora_inicio', 'fecha_hora_fin', 'equipo_reparado', 'observaciones','globalSearch','solicitud_id', 'estado_id','usuario_id'], 'safe'],
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
   /* public function search($params)
    {
        $query = AsignacionSolicitud::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'asignacion_id' => $this->asignacion_id,
            'solicitud_id' => $this->solicitud_id,
            'estado_id' => $this->estado_id,
            'usuario_id' => $this->usuario_id,
            'fecha_hora_inicio' => $this->fecha_hora_inicio,
            'fecha_hora_fin' => $this->fecha_hora_fin,
            'numero_inventario' => $this->numero_inventario,
        ]);

        $query->andFilterWhere(['like', 'equipo_reparado', $this->equipo_reparado])
            ->andFilterWhere(['like', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }*/
        public function search($params,$user_id,$role_id)
    {
        $query = AsignacionSolicitud::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $this->load($params);

        if (!$this->validate()) {           
            return $dataProvider;
        }

        
      $query->joinWith('user');
      $query->joinWith('solicitud');
      $query->joinWith('estado');
      //$query->where(['user_id'=> (Yii::$app->user->identity->id)]);
      if ($role_id!=$this->role_id_constante) {
           $query->where(['user.id'=>$user_id]);
        }

      $query->andFilterWhere([
            'asignacion_id' => $this->asignacion_id,
            'user_id' => $this->usuario_id,
        ]);

      $query->andFilterWhere(['like', 'asignacion_id', $this->globalSearch])
            ->andFilterWhere(['like', 'numero_inventario', $this->globalSearch])
            ->andFilterWhere(['like', 'equipo_reparado', $this->globalSearch])
            ->andFilterWhere(['like', 'user.nombre_completo', $this->globalSearch])
            ->andFilterWhere(['like', 'estado.nombre', $this->globalSearch])
            ->andFilterWhere(['like', 'solicitud.description', $this->globalSearch])
            ->andFilterWhere(['like', 'observaciones', $this->globalSearch])
            ->andFilterWhere(['like', 'fecha_hora_inicio', $this->globalSearch])
            ->andFilterWhere(['like', 'fecha_hora_fin', $this->globalSearch]); 

        return $dataProvider;        
    }
}
