<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "balancegeneral".
 *
 * @property integer $idBalance
 * @property string $fechaIni
 * @property string $fechaFin
 */
class Balancegeneral extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balancegeneral';
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
     * @return BalancegeneralQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BalancegeneralQuery(get_called_class());
    }
}
