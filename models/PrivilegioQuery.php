<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Privilegio]].
 *
 * @see Privilegio
 */
class PrivilegioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Privilegio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Privilegio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
