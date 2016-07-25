<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturacompra".
 *
 * @property integer $codigoResp
 * @property integer $tipo
 * @property double $nit
 * @property string $razonSocial
 * @property integer $nroFactura
 * @property integer $poliza
 * @property integer $nroAutorizacion
 * @property string $fecha
 * @property double $subtotal
 * @property double $ICE
 * @property double $descuento
 * @property double $total
 * @property double $IVA
 * @property string $codigoControl
 * @property integer $id_Empresa
 *
 * @property Respaldo $codigoResp0
 * @property Empresa $empresa
 */
class Facturacompra extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facturacompra';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoResp', 'tipo', 'nit', 'razonSocial', 'nroFactura', 'poliza', 'nroAutorizacion', 'fecha', 'subtotal', 'ICE', 'descuento', 'total', 'IVA', 'codigoControl', 'id_Empresa'], 'required'],
            [['codigoResp', 'tipo', 'nroFactura', 'poliza', 'nroAutorizacion', 'id_Empresa'], 'integer'],
            [['nit', 'subtotal', 'ICE', 'descuento', 'total', 'IVA'], 'number'],
            [['fecha'], 'safe'],
            [['razonSocial'], 'string', 'max' => 50],
            [['codigoControl'], 'string', 'max' => 20],
            [['codigoResp'], 'exist', 'skipOnError' => true, 'targetClass' => Respaldo::className(), 'targetAttribute' => ['codigoResp' => 'codigoRespaldo']],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigoResp' => Yii::t('app', 'Codigo Resp'),
            'tipo' => Yii::t('app', 'Tipo'),
            'nit' => Yii::t('app', 'Nit'),
            'razonSocial' => Yii::t('app', 'Razon Social'),
            'nroFactura' => Yii::t('app', 'Nro Factura'),
            'poliza' => Yii::t('app', 'Poliza'),
            'nroAutorizacion' => Yii::t('app', 'Nro Autorizacion'),
            'fecha' => Yii::t('app', 'Fecha'),
            'subtotal' => Yii::t('app', 'Subtotal'),
            'ICE' => Yii::t('app', 'ICE (Impuesto al Consumo Específico'),
            'descuento' => Yii::t('app', 'Descuento'),
            'total' => Yii::t('app', 'Total'),
            'IVA' => Yii::t('app', 'IVA (Impuesto al Valor Agregado)'),
            'codigoControl' => Yii::t('app', 'Codigo Control'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoResp0()
    {
        return $this->hasOne(Respaldo::className(), ['codigoRespaldo' => 'codigoResp']);
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
     * @return FacturacompraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacturacompraQuery(get_called_class());
    }
}
