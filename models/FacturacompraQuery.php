<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Facturacompra]].
 *
 * @see Facturacompra
 */
class FacturacompraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Facturacompra[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Facturacompra|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
