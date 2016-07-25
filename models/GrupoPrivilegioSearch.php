<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GrupoPrivilegio;

/**
 * GrupoPrivilegioSearch represents the model behind the search form about `app\models\GrupoPrivilegio`.
 */
class GrupoPrivilegioSearch extends GrupoPrivilegio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Privilegio', 'id_Grupo', 'id_Empresa'], 'integer'],
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
        $query = GrupoPrivilegio::find();

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
        $grupo=new Grupousuario();
        $grupo->find()->where(['idGrupo'=>$this->id_Grupo])->one();
        // grid filtering conditions
        $iduser = Yii::$app->user->getId();
        $empresa = Usuario::find()->where(['idUsuario'=>$iduser])->one();
        $idemp = $empresa -> id_Empresa;
        $query->andFilterWhere([
            
            'id_Privilegio' => $this->id_Privilegio,
            'id_Grupo' => $grupo->descripcion,
            'id_Empresa' => $idemp,
        ]);

        return $dataProvider;
    }
}
