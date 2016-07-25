<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Librodiario]].
 *
 * @see Librodiario
 */
class LibrodiarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Librodiario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Librodiario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
