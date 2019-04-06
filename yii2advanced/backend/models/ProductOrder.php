<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%product_order}}".
 *
 * @property int $order_id
 * @property string $shop_name
 *
 * @property OrderDetail[] $orderDetails
 * @property Product[] $productIdIndices
 */
class ProductOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_name'], 'required'],
            [['shop_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'shop_name' => 'Shop Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id_index' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductIdIndices()
    {
        return $this->hasMany(Product::className(), ['product_id' => 'product_id_index'])->viaTable('{{%order_detail}}', ['order_id_index' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductOrderQuery(get_called_class());
    }
}
