<?php
//use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\assets\ChartJsAsset;
use yii\web\View;

$this->title = 'Example report';
$this->params['breadcrumbs'][] = $this->title;

ChartJsAsset::register($this);
$PieChart_Labels = "";
$PieChart_Values = "";
if($sold_data)
{
	$PieChart_Labels = "'".implode("','",ArrayHelper::getColumn($sold_data, 'product_name'))."'";
	$PieChart_Values = implode(",",ArrayHelper::getColumn($sold_data, 'amount'));
}


$this->registerJs(" 
//Doughnut Chart
var ctx = document.getElementById('myChart4').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data: {
        labels: [".$PieChart_Labels."],
        datasets: [{
            label: \"My First dataset\",
            backgroundColor: ['#f6546a','#40e0d0','#ffc125'],
            borderColor: ['#f6546a','#40e0d0','#ffc125'],
            data: [".$PieChart_Values."],
        }]
    },

    // Configuration options go here
    options: {
        responsive: true,
        //maintainAspectRatio: false,
    }
});
", View::POS_READY, 'my-options');

?>

<?php $form = ActiveForm::begin(); ?>
<?= 
	$form->field($model, 'product_id')->dropDownList($product_menu_list);     //Menu dropdown list
?>
<?= '<label class="control-label">Date</label>'; ?>
<?= DatePicker::widget([
	'name' => 'date', 
    'value' => date('d-M-Y'),
    
	'options' => ['placeholder' => 'Select issue date ...'],
	'pluginOptions' => [
		'format' => 'dd-M-yyyy',
		'todayHighlight' => true
	]
]); ?>
<div class="form-group">
<br/>
        <div>
            <?= Html::submitButton('Generate report', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

<?php 
	if($sold_data)
	{
		echo '<div class="panel panel-body">';
		echo '<canvas id="myChart4" style="height:40vh; width:80vw"></canvas>'; 
		echo '</div>';
	}
?>
