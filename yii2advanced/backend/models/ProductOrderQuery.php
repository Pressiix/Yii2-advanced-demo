<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ProductOrder]].
 *
 * @see ProductOrder
 */
class ProductOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProductOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProductOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
