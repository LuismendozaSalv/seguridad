<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nivel".
 *
 * @property integer $idNivel
 * @property string $descripcion
 * @property integer $id_Empresa
 *
 * @property Cuenta[] $cuentas
 * @property Empresa $empresa
 */
class Nivel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nivel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_Empresa'], 'required'],
            [['id_Empresa'], 'integer'],
            [['descripcion'], 'string', 'max' => 20],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNivel' => Yii::t('app', 'Id Nivel'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentas()
    {
        return $this->hasMany(Cuenta::className(), ['id_Nivel' => 'idNivel']);
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
     * @return NivelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NivelQuery(get_called_class());
    }
}
