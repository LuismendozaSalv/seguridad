<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "librodiario".
 *
 * @property integer $idDiario
 * @property string $fechaIni
 * @property string $fechaFin
 */
class Librodiario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'librodiario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaIni', 'fechaFin'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDiario' => Yii::t('app', 'Id Diario'),
            'fechaIni' => Yii::t('app', 'Fecha Inicio'),
            'fechaFin' => Yii::t('app', 'Fecha Fin'),
        ];
    }

    /**
     * @inheritdoc
     * @return LibrodiarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LibrodiarioQuery(get_called_class());
    }
}
