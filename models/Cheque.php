<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cheque".
 *
 * @property integer $codigoResp
 * @property integer $nroCuenta
 * @property string $nombreReceptor
 * @property double $monto
 * @property string $fecha
 * @property integer $id_Empresa
 *
 * @property Respaldo $codigoResp0
 * @property Empresa $empresa
 */
class Cheque extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cheque';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoResp', 'nroCuenta', 'nombreReceptor', 'monto', 'fecha', 'id_Empresa'], 'required'],
            [['codigoResp', 'nroCuenta', 'id_Empresa'], 'integer'],
            [['monto'], 'number'],
            [['fecha'], 'safe'],
            [['nombreReceptor'], 'string', 'max' => 70],
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
            'nroCuenta' => Yii::t('app', 'Nro Cuenta'),
            'nombreReceptor' => Yii::t('app', 'Nombre Receptor'),
            'monto' => Yii::t('app', 'Monto'),
            'fecha' => Yii::t('app', 'Fecha'),
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
     * @return ChequeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChequeQuery(get_called_class());
    }
}
