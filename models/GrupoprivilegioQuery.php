<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GrupoPrivilegio]].
 *
 * @see GrupoPrivilegio
 */
class GrupoprivilegioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return GrupoPrivilegio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GrupoPrivilegio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
