<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%order_detail}}".
 *
 * @property int $order_id_index
 * @property int $product_id_index
 *
 * @property Product $productIdIndex
 * @property ProductOrder $orderIdIndex
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id_index', 'product_id_index'], 'required'],
            [['order_id_index', 'product_id_index'], 'integer'],
            [['order_id_index', 'product_id_index'], 'unique', 'targetAttribute' => ['order_id_index', 'product_id_index']],
            [['product_id_index'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id_index' => 'product_id']],
            [['order_id_index'], 'exist', 'skipOnError' => true, 'targetClass' => ProductOrder::className(), 'targetAttribute' => ['order_id_index' => 'order_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id_index' => 'Order Id Index',
            'product_id_index' => 'Product Id Index',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductIdIndex()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id_index']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderIdIndex()
    {
        return $this->hasOne(ProductOrder::className(), ['order_id' => 'order_id_index']);
    }

    /**
     * {@inheritdoc}
     * @return OrderDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderDetailQuery(get_called_class());
    }
}
