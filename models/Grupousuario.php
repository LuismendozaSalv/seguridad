<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupousuario".
 *
 * @property integer $idGrupo
 * @property string $descripcion
 * @property integer $id_Empresa
 *
 * @property Grupopriviliegio[] $grupopriviliegios
 * @property Privilegio[] $privilegios
 * @property Empresa $empresa
 * @property Usuario[] $usuarios
 */
class Grupousuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return 'grupousuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_Empresa'], 'required'],
            [['id_Empresa'], 'integer'],
            [['descripcion'], 'string', 'max' => 50],
            ['descripcion', 'match', 'pattern' => "/^[a-z ]+$/i", 'message' => 'Sólo se aceptan letras'],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
            
        ];
    }

        /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGrupo' => Yii::t('app', 'Id Grupo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupopriviliegios()
    {
        return $this->hasMany(Grupopriviliegio::className(), ['id_Grupo' => 'idGrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivilegios()
    {
        return $this->hasMany(Privilegio::className(), ['idPrivilegio' => 'id_Privilegio'])->viaTable('grupopriviliegio', ['id_Grupo' => 'idGrupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['idEmpresa' => 'id_Empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_Grupo' => 'idGrupo']);
    }

    /**
     * @inheritdoc
     * @return GrupousuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrupousuarioQuery(get_called_class());
    }
    public function getGrupoU(){
        return $this -> hasOne(Rol::className(), ['idGrupo' => 'id_Grupo']);
    }
}
