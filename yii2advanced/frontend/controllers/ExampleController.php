<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl; 
use frontend\models\ExampleForm;
use frontend\models\ExampleReportForm;
use \yii\web\HttpException;
use yii\helpers\ArrayHelper;

class ExampleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function actionExampleForm()
    {
        $model = new ExampleForm();
        if (\Yii::$app->user->can('view_form')) {      //Check user permission
            return $this->render('example_form', [
                'model' => $model,
            ]);
        }
        else{
            throw new HttpException(404,"You not allow to see this page!!");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function actionExampleChart()
    {
        if (\Yii::$app->user->can('view_chart')) {     //Check user permission
            return $this->render('example_chart', []);
        }
        else{
            throw new HttpException(404,"You not allow to see this page!!");
        }
    }

    public function actionExampleReport()
    {
        $product_id = "";
        $product_name = "";
        /*$date = "";
        $product_menu_list = [];
        $product_info = [];*/
        $sold_data = [];
        $product_sold_info = [];
        $product_sold_summary = [];
        $model = new ExampleReportForm();

        if ($model->load(Yii::$app->request->post())) 
        {
            $product_id = Yii::$app->request->post('ExampleReportForm')['product'];//Get product ID from user
            $date = Yii::$app->request->post('ExampleReportForm')['date'];      //Get date from user
            $product_info = Yii::$app->getDb('db')->createCommand('
                SELECT * 
                FROM PRODUCT P JOIN ORDER_DETAIL O ON P.PRODUCT_ID = O.PRODUCT_ID_INDEX
            ')->queryAll();

            $product_menu_list = ArrayHelper::map($product_info, 'product_id', 'product_name');
            $unique_sold_item_id = array_unique(ArrayHelper::getColumn($product_info, 'product_id'));   //get the list of sold item id by unique values
            $count_sold_item = array_count_values(ArrayHelper::getColumn($product_info, 'product_id')); //count sold item foreach product id [PIE CHART]
            $unique_sold_item_name =array_unique(ArrayHelper::getColumn($product_info, 'product_name')); //get the list of sold item name by unique values
            foreach ($unique_sold_item_id as $key => $value)                                        //Generate sold data for Pie chart
            {    if(!isset($sold_item_index))
                {
                    $sold_item_index = 0;
                }       
                $sold_data[$sold_item_index]['product_id'] = $unique_sold_item_id[$key];
                $sold_data[$sold_item_index]['product_name'] = (string)$unique_sold_item_name[$key];
                $sold_data[$sold_item_index]['amount'] = $count_sold_item[$unique_sold_item_id[$key]];
                $sold_item_index++;
            } 
            
            foreach(ArrayHelper::getColumn($product_info, 'product_name') as $index => $value )   //Generate sold data for Data table
            {
                if($product_info[$index]['product_id'] == $product_id)
                {
                    $product_sold_info[$index]['product_name'] = $product_info[$index]['product_name'];
                    $product_sold_info[$index]['shop_name'] = $product_info[$index]['shop_name'];
                }
            }
            $product_sold_summary = array_count_values(ArrayHelper::getColumn($product_sold_info, 'shop_name'));
            $product_name = implode("",array_unique(ArrayHelper::getColumn($product_sold_info, 'product_name')));
        }
        else
        {
            $product_info = Yii::$app->getDb('db')->createCommand('
                SELECT * 
                FROM PRODUCT 
            ')->queryAll();

            $product_menu_list = ArrayHelper::map($product_info, 'product_id', 'product_name');
        }
    
        return $this->render('example_report', [
            'model' => $model,
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_menu_list' => $product_menu_list,
            'sold_data' => $sold_data,
            'product_info' => $product_info,
            'product_sold_summary' => $product_sold_summary
        ]);
    }
}