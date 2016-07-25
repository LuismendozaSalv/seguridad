<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cuenta]].
 *
 * @see Cuenta
 */
class CuentaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cuenta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cuenta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
