<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuenta".
 *
 * @property string $codigoCuenta
 * @property string $descripcion
 * @property string $codPadre
 * @property integer $id_Empresa
 * @property integer $id_Nivel
 * @property integer $cod_Grupo
 *
 * @property Empresa $empresa
 * @property Cuenta $codPadre0
 * @property Cuenta[] $cuentas
 * @property Nivel $nivel
 * @property Grupocuenta $codGrupo
 * @property Detalleasiento[] $detalleasientos
 * @property Asiento[] $asientos
 */
class Cuenta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuenta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigoCuenta', 'descripcion', 'id_Nivel', 'cod_Grupo'], 'required'],
            [['id_Empresa', 'id_Nivel', 'cod_Grupo'], 'integer'],
            [['codigoCuenta', 'codPadre'], 'string', 'max' => 20],
            [['descripcion'], 'string', 'max' => 50],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
            [['codPadre'], 'exist', 'skipOnError' => true, 'targetClass' => Cuenta::className(), 'targetAttribute' => ['codPadre' => 'codigoCuenta']],
            [['id_Nivel'], 'exist', 'skipOnError' => true, 'targetClass' => Nivel::className(), 'targetAttribute' => ['id_Nivel' => 'idNivel']],
            [['cod_Grupo'], 'exist', 'skipOnError' => true, 'targetClass' => Grupocuenta::className(), 'targetAttribute' => ['cod_Grupo' => 'codGrupo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigoCuenta' => Yii::t('app', 'Codigo Cuenta'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'codPadre' => Yii::t('app', 'Nivel Superior'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
            'id_Nivel' => Yii::t('app', 'Nivel de cuenta'),
            'cod_Grupo' => Yii::t('app', 'Grupo de Cuenta'),
        ];
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
    public function getCodPadre0()
    {
        return $this->hasOne(Cuenta::className(), ['codigoCuenta' => 'codPadre']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentas()
    {
        return $this->hasMany(Cuenta::className(), ['codPadre' => 'codigoCuenta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivel()
    {
        return $this->hasOne(Nivel::className(), ['idNivel' => 'id_Nivel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodGrupo()
    {
        return $this->hasOne(Grupocuenta::className(), ['codGrupo' => 'cod_Grupo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleasientos()
    {
        return $this->hasMany(Detalleasiento::className(), ['codigo_Cuenta' => 'codigoCuenta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientos()
    {
        return $this->hasMany(Asiento::className(), ['idAsiento' => 'id_Asiento'])->viaTable('detalleasiento', ['codigo_Cuenta' => 'codigoCuenta']);
    }

    /**
     * @inheritdoc
     * @return CuentaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CuentaQuery(get_called_class());
    }
}
