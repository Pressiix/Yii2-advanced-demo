<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $product_id
 * @property string $product_name
 * @property int $Quantity
 * @property string $price
 *
 * @property OrderDetail[] $orderDetails
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'Quantity', 'price'], 'required'],
            [['Quantity'], 'integer'],
            [['price'], 'number'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'Quantity' => 'Quantity',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['product_id_index' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
