<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Edificio;

/**
 * EdificioSearch represents the model behind the search form about `backend\models\Edificio`.
 */
class EdificioSearch extends Edificio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edificio_id'], 'integer'],
            [['nombre_edificio', 'ubicacion'], 'safe'],
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
        $query = Edificio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'edificio_id' => $this->edificio_id,
        ]);

        $query->andFilterWhere(['like', 'nombre_edificio', $this->nombre_edificio])
            ->andFilterWhere(['like', 'ubicacion', $this->ubicacion]);

        return $dataProvider;
    }
}
