<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetalleAsiento;

/**
 * DetalleAsientoSearch represents the model behind the search form about `app\models\DetalleAsiento`.
 */
class DetalleAsientoSearch extends DetalleAsiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Asiento', 'id_Empresa'], 'integer'],
            [['codigo_Cuenta'], 'safe'],
            [['debe', 'haber'], 'number'],
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
        $query = DetalleAsiento::find();

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
        $iduser = Yii::$app->user->getId();
        $empresa = Usuario::find()->where(['idUsuario'=>$iduser])->one();
        $idemp = $empresa -> id_Empresa;
        // grid filtering conditions
        $query->andFilterWhere([
            'id_Asiento' => $this->id_Asiento,
            'debe' => $this->debe,
            'haber' => $this->haber,
            'id_Empresa' => $idemp,

        ]);

        $query->andFilterWhere(['like', 'codigo_Cuenta', $this->codigo_Cuenta]);

        return $dataProvider;
    }
}
