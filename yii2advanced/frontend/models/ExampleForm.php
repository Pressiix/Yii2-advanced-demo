<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class ExampleForm extends Model
{
    public $text;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //['text', 'required']
        ];
    }

   
   
}
