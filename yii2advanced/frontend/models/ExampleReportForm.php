<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ExampleReportForm extends Model
{
    public $product_id;
    public $date;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id','date'], 'required']
        ];
    }

   
   
}
