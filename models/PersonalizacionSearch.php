<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Personalizacion;

/**
 * PersonalizacionSearch represents the model behind the search form about `app\models\Personalizacion`.
 */
class PersonalizacionSearch extends Personalizacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPersonalizacion', 'id_Usuario', 'id_Empresa'], 'integer'],
            [['Color', 'tamano', 'Fuente'], 'safe'],
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
        $query = Personalizacion::find();

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
            'idPersonalizacion' => $this->idPersonalizacion,
            'id_Usuario' => $this->id_Usuario,
            'id_Empresa' => $idemp,
        ]);

        $query->andFilterWhere(['like', 'Color', $this->Color])
            ->andFilterWhere(['like', 'tamano', $this->tamano])
            ->andFilterWhere(['like', 'Fuente', $this->Fuente]);

        return $dataProvider;
    }
}
