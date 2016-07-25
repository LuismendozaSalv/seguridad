<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Grupousuario]].
 *
 * @see Grupousuario
 */
class GrupousuarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Grupousuario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Grupousuario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
