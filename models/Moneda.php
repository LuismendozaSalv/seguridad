<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "moneda".
 *
 * @property integer $codMoneda
 * @property string $tipoMoneda
 * @property string $simbolo
 * @property integer $id_Empresa
 *
 * @property Asiento[] $asientos
 * @property Empresa $empresa
 */
class Moneda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'moneda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Empresa'], 'required'],
            [['id_Empresa'], 'integer'],
            [['tipoMoneda'], 'string', 'max' => 20],
            [['simbolo'], 'string', 'max' => 5],
            ['tipoMoneda', 'match', 'pattern' => "/^[a-z ]+$/i", 'message' => 'Sólo se aceptan letras'],
            ['simbolo', 'match', 'pattern' => "/^[a-z.$]+$/i", 'message' => 'Sólo se aceptan letras'],
            [['id_Empresa'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['id_Empresa' => 'idEmpresa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codMoneda' => Yii::t('app', 'Cod Moneda'),
            'tipoMoneda' => Yii::t('app', 'Tipo Moneda'),
            'simbolo' => Yii::t('app', 'Simbolo'),
            'id_Empresa' => Yii::t('app', 'Id  Empresa'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsientos()
    {
        return $this->hasMany(Asiento::className(), ['cod_Moneda' => 'codMoneda']);
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
     * @return MonedaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MonedaQuery(get_called_class());
    }
}
