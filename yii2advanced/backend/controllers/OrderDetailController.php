<?php

namespace backend\controllers;

use Yii;
use backend\models\OrderDetail;
use backend\models\OrderDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderDetailController implements the CRUD actions for OrderDetail model.
 */
class OrderDetailController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderDetail model.
     * @param integer $order_id
     * @param integer $product_id_index
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($order_id, $product_id_index)
    {
        return $this->render('view', [
            'model' => $this->findModel($order_id, $product_id_index),
        ]);
    }

    /**
     * Creates a new OrderDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'order_id' => $model->order_id, 'product_id_index' => $model->product_id_index]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing OrderDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $order_id
     * @param integer $product_id_index
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($order_id, $product_id_index)
    {
        $model = $this->findModel($order_id, $product_id_index);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'order_id' => $model->order_id, 'product_id_index' => $model->product_id_index]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OrderDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $order_id
     * @param integer $product_id_index
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($order_id, $product_id_index)
    {
        $this->findModel($order_id, $product_id_index)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $order_id
     * @param integer $product_id_index
     * @return OrderDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($order_id, $product_id_index)
    {
        if (($model = OrderDetail::findOne(['order_id' => $order_id, 'product_id_index' => $product_id_index])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
