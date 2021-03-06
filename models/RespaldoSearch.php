<?php

namespace app\models;

use Yii;
use yii\base\Model;

use yii\data\ActiveDataProvider;


/**
 * RespaldoSearch represents the model behind the search form about `app\models\Respaldo`.
 */
class RespaldoSearch extends Respaldo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoRespaldo', 'id_Asiento', 'id_Empresa'], 'integer'],
            [['descripcion', 'tipoResp'], 'safe'],
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
        $query = Respaldo::find();

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
        $iduser = Yii::$app->user->getId();
        $empresa = Usuario::find()->where(['idUsuario'=>$iduser])->one();
        $idemp = $empresa -> id_Empresa;
        
        $query->andFilterWhere([
            'codigoRespaldo' => $this->codigoRespaldo,
            'id_Asiento' => $this->id_Asiento,
            'id_Empresa' => $idemp,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'tipoResp', $this->tipoResp]);

        return $dataProvider;
    }
}
