<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Balancesumassaldos]].
 *
 * @see Balancesumassaldos
 */
class BalancesumassaldosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Balancesumassaldos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Balancesumassaldos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
