<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Grupocuenta]].
 *
 * @see Grupocuenta
 */
class GrupocuentaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Grupocuenta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Grupocuenta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
