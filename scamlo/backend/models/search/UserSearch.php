<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'telefono'], 'integer'],
            [['nombre_completo', 'status_id', 'cedula', 'email', 'created_at', 'updated_at', 'roleName', 'statusName', 'role_id'], 'safe'],
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

    public function search($params)
    {

        $query = User::find();

        $dataProvider = new ActiveDataProvider([

            'query' => $query,

            ]);

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {

            return $dataProvider;

        }

        $query->joinWith('role');
        $query->joinWith('status');

        $query->andFilterWhere([

            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ]);

        $query->andFilterWhere(['like', 'nombre_completo', $this->nombre_completo])

        ->andFilterWhere(['like', 'auth_key', $this->auth_key])
        ->andFilterWhere(['like', 'password_hash', $this->password_hash])
        ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'role.role_name', $this->role_id])
        ->andFilterWhere(['like', 'status.status_name', $this->status_id]);

        return $dataProvider;

    }
}