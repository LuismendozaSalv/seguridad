<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Asiento;

/**
 * AsientoSearch represents the model behind the search form about `app\models\Asiento`.
 */
class AsientoSearch extends Asiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idAsiento', 'id_Usuario', 'cod_Moneda', 'id_TipoA', 'id_Empresa'], 'integer'],
            [['glosa', 'fecha'], 'safe'],
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
        $query = Asiento::find();

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
            'idAsiento' => $this->idAsiento,
            'fecha' => $this->fecha,
            'id_Usuario' => $this->id_Usuario,
            'cod_Moneda' => $this->cod_Moneda,
            'id_TipoA' => $this->id_TipoA,
            'id_Empresa' => $idemp,
        ]);

        $query->andFilterWhere(['like', 'glosa', $this->glosa]);

        return $dataProvider;
    }
}
