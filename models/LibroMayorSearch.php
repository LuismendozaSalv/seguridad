<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LibroMayor;

/**
 * LibroMayorSearch represents the model behind the search form about `app\models\LibroMayor`.
 */
class LibroMayorSearch extends LibroMayor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMayor'], 'integer'],
            [['codCuenta', 'fechaIni', 'fechaFin'], 'safe'],
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
        $query = LibroMayor::find();

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
            'idMayor' => $this->idMayor,
            'fechaIni' => $this->fechaIni,
            'fechaFin' => $this->fechaFin,
        ]);

        $query->andFilterWhere(['like', 'codCuenta', $this->codCuenta]);

        return $dataProvider;
    }
}
