<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Espacio;

/**
 * EspacioSearch represents the model behind the search form about `backend\models\Espacio`.
 */
class EspacioSearch extends Espacio
{

    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['espacio_id', 'capacidad'], 'integer'],
            [['codigo', 'ubicacion', 'edificio_id', 'globalSearch', 'nombre'], 'safe'],
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
        $query = Espacio::find();

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

        $query->joinWith('edificio');

        // grid filtering conditions
        $query->andFilterWhere([
            'espacio_id' => $this->espacio_id,
            'capacidad' => $this->capacidad,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'ubicacion', $this->ubicacion])
            ->andFilterWhere(['like', 'edificio.nombre_edificio', $this->edificio_id])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }

    
}
