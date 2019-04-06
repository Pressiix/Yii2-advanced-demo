<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderDetail */

$this->title = $model->order_id_index;
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'order_id_index' => $model->order_id_index, 'product_id_index' => $model->product_id_index], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'order_id_index' => $model->order_id_index, 'product_id_index' => $model->product_id_index], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id_index',
            'product_id_index',
        ],
    ]) ?>

</div>
