<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libromayor".
 *
 * @property integer $idMayor
 * @property string $codCuenta
 * @property string $fechaIni
 * @property string $fechaFin
 */
class Libromayor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'libromayor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaIni', 'fechaFin'], 'safe'],
            [['codCuenta'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMayor' => Yii::t('app', 'Id Mayor'),
            'codCuenta' => Yii::t('app', 'Cod Cuenta'),
            'fechaIni' => Yii::t('app', 'Fecha Inicio'),
            'fechaFin' => Yii::t('app', 'Fecha Fin'),
        ];
    }

    /**
     * @inheritdoc
     * @return LibromayorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LibromayorQuery(get_called_class());
    }
}
