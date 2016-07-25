<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Moneda]].
 *
 * @see Moneda
 */
class MonedaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Moneda[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Moneda|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
