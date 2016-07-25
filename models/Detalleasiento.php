<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detalleasiento".
 *
 * @property integer $id_Asiento
 * @property string $codigo_Cuenta
 * @property double $debe
 * @property double $haber
 * @property integer $id_Empresa
 *
 * @property Asiento $asiento
 * @property Cuenta $codigoCuenta
 * @property Empresa $empresa
 * @property Respaldo[] $respaldos
 */
class Detalleasiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detalleasiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Asiento', 'codigo_Cuenta', 'id_Empresa'], 'required'],
            [['id_Asiento'], 'integer'],
            [['debe', 'haber'], 'number'],
            [['codigo_Cuenta'], 'string', 'max' => 20],
            [['id_Asiento'], 'exist', 'skipOnError' => true, 'targetClass' => Asiento::className(), 'targetAttribute' => ['id_Asiento' => 'idAsiento']],
            [['codigo_Cuenta'], 'exist', 'skipOnError' => true, 'targetClass' => Cuenta::className(), 'targetAttribute' => ['codigo_Cuenta' => 'codigoCuenta']],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_Asiento' => Yii::t('app', 'Id  Asiento'),
            'codigo_Cuenta' => Yii::t('app', 'Codigo  Cuenta'),
            'debe' => Yii::t('app', 'Debe'),
            'haber' => Yii::t('app', 'Haber'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
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
    public function getCodigoCuenta()
    {
        return $this->hasOne(Cuenta::className(), ['codigoCuenta' => 'codigo_Cuenta']);
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
    public function getRespaldos()
    {
        return $this->hasMany(Respaldo::className(), ['id_Asiento' => 'id_Asiento', 'codigo_Cuenta' => 'codigo_Cuenta']);
    }

    /**
     * @inheritdoc
     * @return DetalleasientoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DetalleasientoQuery(get_called_class());
    }
}
