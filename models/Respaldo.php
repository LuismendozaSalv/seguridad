<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respaldo".
 *
 * @property integer $codigoRespaldo
 * @property string $descripcion
 * @property integer $id_Asiento
 * @property integer $id_Empresa
 * @property string $tipoResp
 *
 * @property Cheque $cheque
 * @property Facturacompra $facturacompra
 * @property Facturaventa $facturaventa
 * @property Asiento $asiento
 * @property Empresa $empresa
 */
class Respaldo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respaldo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_Empresa'], 'required'],
            [['descripcion'], 'string'],
            [['id_Asiento', 'id_Empresa'], 'integer'],
            [['tipoResp'], 'string', 'max' => 1],
            [['id_Asiento'], 'exist', 'skipOnError' => true, 'targetClass' => Asiento::className(), 'targetAttribute' => ['id_Asiento' => 'idAsiento']],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigoRespaldo' => Yii::t('app', 'Codigo Respaldo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'id_Asiento' => Yii::t('app', 'Id  Asiento'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
            'tipoResp' => Yii::t('app', 'Tipo de Respaldo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheque()
    {
        return $this->hasOne(Cheque::className(), ['codigoResp' => 'codigoRespaldo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturacompra()
    {
        return $this->hasOne(Facturacompra::className(), ['codigoResp' => 'codigoRespaldo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventa()
    {
        return $this->hasOne(Facturaventa::className(), ['codigoResp' => 'codigoRespaldo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsiento()
    {
        return $this->hasOne(Asiento::className(), ['idAsiento' => 'id_Asiento']);
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
     * @return RespaldoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RespaldoQuery(get_called_class());
    }
}
