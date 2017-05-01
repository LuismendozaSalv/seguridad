<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $idEmpresa
 * @property double $nit
 * @property string $razonSocial
 * @property string $direccion
 * @property string $ciudad
 * @property string $pais
 * @property integer $telefono
 *
 * @property Asiento[] $asientos
 * @property Bitacora[] $bitacoras
 * @property Cheque[] $cheques
 * @property Cuenta[] $cuentas
 * @property Detalleasiento[] $detalleasientos
 * @property Facturacompra[] $facturacompras
 * @property Facturaventa[] $facturaventas
 * @property Grupocuenta[] $grupocuentas
 * @property Grupopriviliegio[] $grupopriviliegios
 * @property Grupousuario[] $grupousuarios
 * @property Moneda[] $monedas
 * @property Nivel[] $nivels
 * @property Personalizacion[] $personalizacions
 * @property Privilegio[] $privilegios
 * @property Respaldo[] $respaldos
 * @property Tipoasiento[] $tipoasientos
 * @property Usuario[] $usuarios
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nit', 'razonSocial'], 'required'],
            [['nit'], 'number'],
            [['telefono'], 'integer'],
            [['razonSocial', 'direccion', 'ciudad', 'pais'], 'string', 'max' => 50],
            [['nit'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEmpresa' => Yii::t('app', 'Id Empresa'),
            'nit' => Yii::t('app', 'Nit'),
            'razonSocial' => Yii::t('app', 'Razon Social'),
            'direccion' => Yii::t('app', 'Direccion'),
            'ciudad' => Yii::t('app', 'Ciudad'),
            'pais' => Yii::t('app', 'Pais'),
            'telefono' => Yii::t('app', 'Telefono'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientos()
    {
        return $this->hasMany(Asiento::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoras()
    {
        return $this->hasMany(Bitacora::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheques()
    {
        return $this->hasMany(Cheque::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentas()
    {
        return $this->hasMany(Cuenta::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetalleasientos()
    {
        return $this->hasMany(Detalleasiento::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturacompras()
    {
        return $this->hasMany(Facturacompra::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacturaventas()
    {
        return $this->hasMany(Facturaventa::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupocuentas()
    {
        return $this->hasMany(Grupocuenta::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupopriviliegios()
    {
        return $this->hasMany(Grupopriviliegio::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupousuarios()
    {
        return $this->hasMany(Grupousuario::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMonedas()
    {
        return $this->hasMany(Moneda::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivels()
    {
        return $this->hasMany(Nivel::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalizacions()
    {
        return $this->hasMany(Personalizacion::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivilegios()
    {
        return $this->hasMany(Privilegio::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespaldos()
    {
        return $this->hasMany(Respaldo::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoasientos()
    {
        return $this->hasMany(Tipoasiento::className(), ['id_Empresa' => 'idEmpresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_Empresa' => 'idEmpresa']);
    }
}
