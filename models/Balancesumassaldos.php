<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "balancesumassaldos".
 *
 * @property integer $idBalance
 * @property string $fechaIni
 * @property string $fechaFin
 */
class Balancesumassaldos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balancesumassaldos';
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
            'idBalance' => Yii::t('app', 'Id Balance'),
            'fechaIni' => Yii::t('app', 'Fecha Inicial'),
            'fechaFin' => Yii::t('app', 'Fecha Final'),
        ];
    }

    /**
     * @inheritdoc
     * @return BalancesumassaldosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BalancesumassaldosQuery(get_called_class());
    }
}
