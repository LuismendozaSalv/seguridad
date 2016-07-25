<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupoprivilegio".
 *
 * @property integer $id_Privilegio
 * @property integer $id_Grupo
 * @property integer $id_Empresa
 *
 * @property Privilegio $privilegio
 * @property Grupousuario $grupo
 * @property Empresa $empresa
 */
class GrupoPrivilegio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupoprivilegio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Privilegio', 'id_Grupo', 'id_Empresa'], 'required'],
            [['id_Privilegio', 'id_Grupo', 'id_Empresa'], 'integer'],
            [['id_Privilegio'], 'exist', 'skipOnError' => true, 'targetClass' => Privilegio::className(), 'targetAttribute' => ['id_Privilegio' => 'idPrivilegio']],
            [['id_Grupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupousuario::className(), 'targetAttribute' => ['id_Grupo' => 'idGrupo']],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_Privilegio' => Yii::t('app', 'Id  Privilegio'),
            'id_Grupo' => Yii::t('app', 'Id  Grupo'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivilegio()
    {
        return $this->hasOne(Privilegio::className(), ['idPrivilegio' => 'id_Privilegio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupo()
    {
        return $this->hasOne(Grupousuario::className(), ['idGrupo' => 'id_Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['idEmpresa' => 'id_Empresa']);
    }

    /**
     * @inheritdoc
     * @return GrupoprivilegioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrupoprivilegioQuery(get_called_class());
    }
}
