<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Bitacora]].
 *
 * @see Bitacora
 */
class BitacoraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Bitacora[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Bitacora|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
