<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Respaldo]].
 *
 * @see Respaldo
 */
class AQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Respaldo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Respaldo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
