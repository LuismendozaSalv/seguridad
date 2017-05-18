<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $idUsuario
 * @property string $nombre
 * @property string $userName
 * @property string $passwd
 * @property integer $id_Empresa
 * @property string $direccion
 * @property string $telefono
 * @property integer $id_Grupo
 *
 * @property Asiento[] $asientos
 * @property Empresa $empresa
 * @property Grupousuario $grupo
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'userName', 'passwd', 'id_Empresa'], 'required'],
            [['id_Empresa', 'id_Grupo'], 'integer'],
            [['nombre', 'direccion'], 'string', 'max' => 50],
            [['userName'], 'string', 'max' => 20],
            [['passwd'], 'string', 'max' => 25, 'min' => 8],
            [['telefono'], 'string', 'max' => 10],
            [['userName'], 'unique'],
            
            ['nombre', 'match', 'pattern' => "/^[a-z' ]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['userName', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan letras y números'],
            ['telefono', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Sólo se aceptan numeros'],
            ['passwd', 'match', 'pattern' => "/^[0-9a-z]+$/i", 'message' => 'Sólo se aceptan numeros y letras'],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
            [['id_Grupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupousuario::className(), 'targetAttribute' => ['id_Grupo' => 'idGrupo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => Yii::t('app', 'Id Usuario'),
            'nombre' => Yii::t('app', 'Nombre'),
            'userName' => Yii::t('app', 'Nombre Usuario'),
            'passwd' => Yii::t('app', 'Passwd'),
            'id_Empresa' => Yii::t('app', 'Empresa'),
            'direccion' => Yii::t('app', 'Direccion'),
            'telefono' => Yii::t('app', 'Telefono'),
            'id_Grupo' => Yii::t('app', 'Grupo de Usuario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientos()
    {
        return $this->hasMany(Asiento::className(), ['id_Usuario' => 'idUsuario']);
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
    public function getGrupo()
    {
        return $this->hasOne(Grupousuario::className(), ['idGrupo' => 'id_Grupo']);
    }

    /**
     * @inheritdoc
     * @return UsuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioQuery(get_called_class());
    }
}
