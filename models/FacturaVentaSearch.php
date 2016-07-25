<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Facturaventa;

/**
 * FacturaVentaSearch represents the model behind the search form about `app\models\FacturaVenta`.
 */
class FacturaVentaSearch extends Facturaventa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoResp', 'nroFactura', 'nroAutorizacion', 'codigoControl', 'id_Empresa'], 'integer'],
            [['nit', 'subtotal', 'ICE', 'descuento', 'total', 'IVA'], 'number'],
            [['razonSocial', 'fecha', 'validado'], 'safe'],
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
        $query = Facturaventa::find();

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
            'nit' => $this->nit,
            'nroFactura' => $this->nroFactura,
            'nroAutorizacion' => $this->nroAutorizacion,
            'fecha' => $this->fecha,
            'subtotal' => $this->subtotal,
            'ICE' => $this->ICE,
            'descuento' => $this->descuento,
            'total' => $this->total,
            'IVA' => $this->IVA,
            'codigoControl' => $this->codigoControl,
            'id_Empresa' => $idemp,
        ]);

        $query->andFilterWhere(['like', 'razonSocial', $this->razonSocial])
            ->andFilterWhere(['like', 'validado', $this->validado]);

        return $dataProvider;
    }
}
