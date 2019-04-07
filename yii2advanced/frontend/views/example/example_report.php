<?php
use yii\helpers\ArrayHelper;
use common\assets\ChartJsAsset;
use common\assets\ChartJsDataLabelAsset;
use yii\web\View;
use common\assets\DataTableAsset;

$this->title = 'Example report';
$this->params['breadcrumbs'][] = $this->title;
DataTableAsset::register($this);
ChartJsAsset::register($this);
ChartJsDataLabelAsset::register($this);
$PieChart_Labels = "";
$PieChart_Values = "";
if($sold_data)
{
	$PieChart_Labels = "'".implode("','",ArrayHelper::getColumn($sold_data, 'product_name'))."'";
	$PieChart_Values = implode(",",ArrayHelper::getColumn($sold_data, 'amount'));
}


$this->registerJs(" 
var chart = new Chart('myChart4', {
  type: 'bar',
  data: {
    labels: [".$PieChart_Labels."],
    datasets: [{
      backgroundColor: ['rgba(255, 99, 132, 0.4)','rgba(54, 162, 235, 0.4)','rgba(75, 192, 192, 0.4)'],
	  borderColor: ['rgba(255, 99, 132, 0.8)','rgba(54, 162, 235, 0.8)','rgba(75, 192, 192, 0.8)'],
      data: [".$PieChart_Values."]
    }]
  },
  options: {
	scales: {
		yAxes: [{
			ticks: {
				beginAtZero: true,
				userCallback: function(label, index, labels) {
					// when the floored value is the same as the value we have a whole number
					if (Math.floor(label) === label) {
						return label;
					}

				},
			}
		}],
		xAxes: [{
			gridLines: {
                display:false
            }
		}],
	},
  	legend: false,
    plugins: {
      datalabels: {
        align: function(context) {
        	var chart = context.chart;
          var area = chart.chartArea;
          var meta = chart.getDatasetMeta(context.datasetIndex);

          // WARNING: meta.data._model is PRIVATE and thus can 
          // change without notice, breaking code relying on it!
          var model = meta.data[context.dataIndex]._model;
          var bottom = Math.min(model.base, area.bottom);
          var height = bottom - model.y;
          return height < 25 ? 'end' : 'start'
        },
        anchor: 'end',
        backgroundColor: null,
        borderColor: null,
        borderRadius: 4,
        borderWidth: 1,
        color: '#223388',
        font: {
          size: 16,
          weight: 600
        },
        offset: 4,
        padding: 0,
        formatter: function(value) {
        	return Math.round(value * 10) / 10
        }
      }
    }
  },
});

/**********************************DataTable Configuration*********************************************/

$(document).ready(function() {
	var table = $('#example-report').DataTable( {
		lengthChange: true,
		dom: 'Bfrtip',
		buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
	} );

	table.buttons().container()
		.appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );

/******************************************************************************************************/

", View::POS_READY, 'my-options');

?>

<?= $this->render('form/_report_form',[
		'model' => $model,
		'product_menu_list' => $product_menu_list
]) ?>

<?php 
	if($sold_data)			//*************************** *START BODY* *****************************
	{
?>
		<div class="col-md-5">
			<div class="panel panel-red text-center">
				<div class="panel-heading"><h4><b>Sold Item Chart</b></h4></div>
				<div class="panel-body" >
						<canvas id="myChart4" style="height:250px; width:400px;"></canvas>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="panel panel-red">
				<div class="panel-heading text-center"><h4><b>Sales information (<?= $product_name; ?>) </b></h4></div>
				<div class=panel-body" style="height:358px;">
					<div class="container-fluid table-responsive table-responsive-md">
						<br/>
							<table id="example-report" class="table table-bordered table-hover " style="position:center;">
								<thead>
									<tr>
										<th>Shop Name</th>
										<th>Total sold</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach($product_sold_summary as $index => $value)
										{
											echo "
												<tr>
													<td>$index</td>
													<td>$product_sold_summary[$index]</td>
												</tr>
											";
										}
									?>
								</tbody>
							</table>
						<br/>
					</div>
				</div>
			</div>
		</div>
<?php	
	}					//*************************** *END BODY* *****************************
?>
