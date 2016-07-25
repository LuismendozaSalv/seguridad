<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Detalleasiento]].
 *
 * @see Detalleasiento
 */
class DetalleasientoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Detalleasiento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Detalleasiento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
