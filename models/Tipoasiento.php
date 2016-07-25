<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipoasiento".
 *
 * @property integer $idTipo
 * @property string $descripcion
 * @property integer $id_Empresa
 *
 * @property Asiento[] $asientos
 * @property Empresa $empresa
 */
class Tipoasiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipoasiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipo', 'descripcion', 'id_Empresa'], 'required'],
            [['idTipo', 'id_Empresa'], 'integer'],
            [['descripcion'], 'string', 'max' => 50],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipo' => Yii::t('app', 'Id Tipo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientos()
    {
        return $this->hasMany(Asiento::className(), ['id_TipoA' => 'idTipo']);
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
     * @return TipoasientoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipoasientoQuery(get_called_class());
    }
}
