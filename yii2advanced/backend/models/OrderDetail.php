<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%order_detail}}".
 *
 * @property int $order_id
 * @property int $product_id_index
 * @property string $shop_name
 *
 * @property Product $productIdIndex
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
            [['order_id', 'product_id_index', 'shop_name'], 'required'],
            [['order_id', 'product_id_index'], 'integer'],
            [['shop_name'], 'string', 'max' => 255],
            [['order_id', 'product_id_index'], 'unique', 'targetAttribute' => ['order_id', 'product_id_index']],
            [['product_id_index'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id_index' => 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'product_id_index' => 'Product Id Index',
            'shop_name' => 'Shop Name',
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
     * {@inheritdoc}
     * @return OrderDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderDetailQuery(get_called_class());
    }
}
