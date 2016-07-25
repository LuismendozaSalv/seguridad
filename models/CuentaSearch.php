<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cuenta;

/**
 * CuentaSearch represents the model behind the search form about `app\models\Cuenta`.
 */
class CuentaSearch extends Cuenta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoCuenta', 'descripcion', 'codPadre'], 'safe'],
            [['id_Empresa', 'id_Nivel', 'cod_Grupo'], 'integer'],
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
        $query = Cuenta::find();

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

             'id_Empresa' => $idemp,
            'id_Nivel' => $this->id_Nivel,
            'cod_Grupo' => $this->cod_Grupo,
        ]);

        $query->andFilterWhere(['like', 'codigoCuenta', $this->codigoCuenta])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'codPadre', $this->codPadre]);

        return $dataProvider;
    }
}
