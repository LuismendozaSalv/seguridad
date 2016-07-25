<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tipoasiento]].
 *
 * @see Tipoasiento
 */
class TipoasientoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Tipoasiento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tipoasiento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
