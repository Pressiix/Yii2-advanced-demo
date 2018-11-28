<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\ExampleForm;

class ExampleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actionExampleForm()
    {
        $model = new ExampleForm();
            return $this->render('example_form', [
                'model' => $model,
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function actionExampleChart()
    {
            return $this->render('example_chart', []);
       /* }*/
    }
}