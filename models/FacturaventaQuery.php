<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Facturaventa]].
 *
 * @see Facturaventa
 */
class FacturaventaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Facturaventa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Facturaventa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
