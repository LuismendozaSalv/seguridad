<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asiento".
 *
 * @property integer $idAsiento
 * @property string $glosa
 * @property string $fecha
 * @property integer $id_Usuario
 * @property integer $cod_Moneda
 * @property integer $id_TipoA
 * @property integer $id_Empresa
 *
 * @property Usuario $usuario
 * @property Moneda $codMoneda
 * @property Tipoasiento $tipoA
 * @property Empresa $empresa
 * @property Detalleasiento[] $detalleasientos
 * @property Cuenta[] $codigoCuentas
 */
class Asiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['glosa', 'fecha', 'id_Usuario', 'cod_Moneda', 'id_TipoA', 'id_Empresa'], 'required'],
            [['fecha'], 'safe'],
            [['id_Usuario', 'cod_Moneda', 'id_TipoA', 'id_Empresa'], 'integer'],
            [['glosa'], 'string', 'max' => 100],
            [['id_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_Usuario' => 'idUsuario']],
            [['cod_Moneda'], 'exist', 'skipOnError' => true, 'targetClass' => Moneda::className(), 'targetAttribute' => ['cod_Moneda' => 'codMoneda']],
            [['id_TipoA'], 'exist', 'skipOnError' => true, 'targetClass' => Tipoasiento::className(), 'targetAttribute' => ['id_TipoA' => 'idTipo']],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAsiento' => Yii::t('app', 'Id Asiento'),
            'glosa' => Yii::t('app', 'Glosa'),
            'fecha' => Yii::t('app', 'Fecha'),
            'id_Usuario' => Yii::t('app', 'Id  Usuario'),
            'cod_Moneda' => Yii::t('app', 'Moneda'),
            'id_TipoA' => Yii::t('app', 'Tipo Asiento'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'id_Usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodMoneda()
    {
        return $this->hasOne(Moneda::className(), ['codMoneda' => 'cod_Moneda']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoA()
    {
        return $this->hasOne(Tipoasiento::className(), ['idTipo' => 'id_TipoA']);
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
    public function getDetalleasientos()
    {
        return $this->hasMany(Detalleasiento::className(), ['id_Asiento' => 'idAsiento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoCuentas()
    {
        return $this->hasMany(Cuenta::className(), ['codigoCuenta' => 'codigo_Cuenta'])->viaTable('detalleasiento', ['id_Asiento' => 'idAsiento']);
    }

    /**
     * @inheritdoc
     * @return AsientoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsientoQuery(get_called_class());
    }
}
