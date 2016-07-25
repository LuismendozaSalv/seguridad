<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cheque;

/**
 * ChequeSearch represents the model behind the search form about `app\models\Cheque`.
 */
class ChequeSearch extends Cheque
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoResp', 'nroCuenta', 'id_Empresa'], 'integer'],
            [['nombreReceptor', 'fecha'], 'safe'],
            [['monto'], 'number'],
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
        $query = Cheque::find();

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
            'codigoResp' => $this->codigoResp,
            'nroCuenta' => $this->nroCuenta,
            'monto' => $this->monto,
            'fecha' => $this->fecha,
            'id_Empresa' => $idemp,
        ]);

        $query->andFilterWhere(['like', 'nombreReceptor', $this->nombreReceptor]);

        return $dataProvider;
    }
}
