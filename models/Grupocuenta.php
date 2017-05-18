<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupocuenta".
 *
 * @property integer $codGrupo
 * @property string $descripcion
 * @property integer $id_Empresa
 *
 * @property Cuenta[] $cuentas
 * @property Empresa $empresa
 */
class Grupocuenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupocuenta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codGrupo', 'id_Empresa'], 'required'],
            [['codGrupo', 'id_Empresa'], 'integer'],
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
            'codGrupo' => Yii::t('app', 'Cod Grupo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentas()
    {
        return $this->hasMany(Cuenta::className(), ['cod_Grupo' => 'codGrupo']);
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
     * @return GrupocuentaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrupocuentaQuery(get_called_class());
    }
}
