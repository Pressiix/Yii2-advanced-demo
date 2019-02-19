<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ExampleReportForm extends Model
{
    public $name;
    public $date;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','date'], 'required']
        ];
    }

   
   
}
