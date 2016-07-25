<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cheque]].
 *
 * @see Cheque
 */
class ChequeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cheque[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cheque|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
