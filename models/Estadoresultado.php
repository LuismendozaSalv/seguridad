<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estadoresultado".
 *
 * @property integer $idEstado
 * @property string $fechaIni
 * @property string $fechaFin
 */
class Estadoresultado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estadoresultado';
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
            'idEstado' => Yii::t('app', 'Id Estado'),
            'fechaIni' => Yii::t('app', 'Fecha Inicial'),
            'fechaFin' => Yii::t('app', 'Fecha Final'),
        ];
    }

    /**
     * @inheritdoc
     * @return EstadoresultadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EstadoresultadoQuery(get_called_class());
    }
}
