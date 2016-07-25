<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facturaventa".
 *
 * @property integer $codigoResp
 * @property double $nit
 * @property string $razonSocial
 * @property integer $nroFactura
 * @property integer $nroAutorizacion
 * @property string $fecha
 * @property double $subtotal
 * @property double $ICE
 * @property double $descuento
 * @property double $total
 * @property double $IVA
 * @property string $validado
 * @property integer $codigoControl
 * @property integer $id_Empresa
 *
 * @property Respaldo $codigoResp0
 * @property Empresa $empresa
 */
class Facturaventa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facturaventa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoResp', 'nit', 'razonSocial', 'nroFactura', 'nroAutorizacion', 'fecha', 'subtotal', 'ICE', 'descuento', 'total', 'IVA', 'validado', 'codigoControl', 'id_Empresa'], 'required'],
            [['codigoResp', 'nroFactura', 'nroAutorizacion', 'codigoControl', 'id_Empresa'], 'integer'],
            [['nit', 'subtotal', 'ICE', 'descuento', 'total', 'IVA'], 'number'],
            [['fecha'], 'safe'],
            [['razonSocial'], 'string', 'max' => 50],
            [['validado'], 'string', 'max' => 1],
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
            'nit' => Yii::t('app', 'Nit'),
            'razonSocial' => Yii::t('app', 'Razon Social'),
            'nroFactura' => Yii::t('app', 'Nro Factura'),
            'nroAutorizacion' => Yii::t('app', 'Nro Autorizacion'),
            'fecha' => Yii::t('app', 'Fecha'),
            'subtotal' => Yii::t('app', 'Subtotal'),
            'ICE' => Yii::t('app', 'Ice'),
            'descuento' => Yii::t('app', 'Descuento'),
            'total' => Yii::t('app', 'Total'),
            'IVA' => Yii::t('app', 'Iva'),
            'validado' => Yii::t('app', 'Validado'),
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
     * @return FacturaventaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacturaventaQuery(get_called_class());
    }
}
