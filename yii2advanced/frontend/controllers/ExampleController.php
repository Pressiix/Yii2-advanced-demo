<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl; 
use frontend\models\ExampleForm;
use \yii\web\HttpException;

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
}