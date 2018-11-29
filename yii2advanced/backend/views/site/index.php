<?php

use yii\web\View;
use yii\helpers\Html;

$this->title = 'Backend';
/* @var $this yii\web\View */
use common\assets\ChartJsAsset;
//use common\assets\FontawesomeAsset;
ChartJsAsset::register($this);
//FontawesomeAsset::register($this);
$this->registerCss("

");

$this->registerJs(" 

//Line Chart
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: [\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\"],
        datasets: [{
            label: \"My First dataset\",
            backgroundColor: '#40e0d0',
            borderColor: '#40e0d0',
            fill : false,
            lineTension : false,
            data: [0, 10, 5, 2, 20, 30, 45],
        }]
    },

    // Configuration options go here
    options: {}
});

//Bar Chart
var ctx = document.getElementById('myChart2').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: [\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\"],
        datasets: [{
            label: \"My First dataset\",
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [60, 10, 5, 2, 20, 30, 45],
        }]
    },

    // Configuration options go here
    options: {}
});

//Pie Chart
var ctx = document.getElementById('myChart3').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: [\"January\", \"February\", \"March\"],
        datasets: [{
            label: \"My First dataset\",
            backgroundColor: ['#f6546a','#40e0d0','#ffc125'],
            borderColor: ['#f6546a','#40e0d0','#ffc125'],
            data: [ 5, 20, 30],
        }]
    },

    // Configuration options go here
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

//Doughnut Chart
var ctx = document.getElementById('myChart4').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'doughnut',

    // The data for our dataset
    data: {
        labels: [\"January\", \"February\", \"March\"],
        datasets: [{
            label: \"My First dataset\",
            backgroundColor: ['#f6546a','#40e0d0','#ffc125'],
            borderColor: ['#f6546a','#40e0d0','#ffc125'],
            data: [ 75, 20, 30],
        }]
    },

    // Configuration options go here
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});

//Mixed chart
var ctx = document.getElementById('myChart5').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'horizontalBar',

    // The data for our dataset
    data: {
        labels: [\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\"],
        datasets: [{
            label: \"My First dataset\",
            backgroundColor: '#0066CC',
            borderColor: '#0066CC',
            data: [60, 10, 5, 2, 20, 30, 45],
        }]
    },

    // Configuration options go here
    options: {}
});

//Mixed chart
////////////////////////////////////////////////////////////////////
Chart.defaults.groupableBar = Chart.helpers.clone(Chart.defaults.bar);

var helpers = Chart.helpers;
Chart.controllers.groupableBar = Chart.controllers.bar.extend({
			draw: function(ease) {
				Chart.controllers.bar.prototype.draw.apply(this, arguments);

				var self = this;
				// check if this is the last dataset in this stack
				if (!this.chart.data.datasets.some(function (dataset, index) { return (dataset.stack === self.getDataset().stack && index > self.index); })) {
					var ctx = this.chart.chart.ctx;
					ctx.save();
					ctx.textAlign = 'center';
					ctx.textBaseline = 'bottom';
					// loop through all its rectangles and draw the label	
					ctx.restore();
				}
			},
			
calculateBarX: function (index, datasetIndex) {
    // position the bars based on the stack index
    var stackIndex = this.getMeta().stackIndex;
    return Chart.controllers.bar.prototype.calculateBarX.apply(this, [index, stackIndex]);
  },

  hideOtherStacks: function (datasetIndex) {
    var meta = this.getMeta();
    var stackIndex = meta.stackIndex;

    this.hiddens = [];
    for (var i = 0; i < datasetIndex; i++) {
      var dsMeta = this.chart.getDatasetMeta(i);
      if (dsMeta.stackIndex !== stackIndex) {
        this.hiddens.push(dsMeta.hidden);
        dsMeta.hidden = true;
      }
    }
  },

  unhideOtherStacks: function (datasetIndex) {
    var meta = this.getMeta();
    var stackIndex = meta.stackIndex;

    for (var i = 0; i < datasetIndex; i++) {
      var dsMeta = this.chart.getDatasetMeta(i);
      if (dsMeta.stackIndex !== stackIndex) {
        dsMeta.hidden = this.hiddens.unshift();
      }
    }
  },

  calculateBarY: function (index, datasetIndex) {
    this.hideOtherStacks(datasetIndex);
    var barY = Chart.controllers.bar.prototype.calculateBarY.apply(this, [index, datasetIndex]);
    this.unhideOtherStacks(datasetIndex);
    return barY;
  },

  calculateBarBase: function (datasetIndex, index) {
    this.hideOtherStacks(datasetIndex);
    var barBase = Chart.controllers.bar.prototype.calculateBarBase.apply(this, [datasetIndex, index]);
    this.unhideOtherStacks(datasetIndex);
    return barBase;
  },

  getBarCount: function () {
    var stacks = [];

    // put the stack index in the dataset meta
    Chart.helpers.each(this.chart.data.datasets, function (dataset, datasetIndex) {
      var meta = this.chart.getDatasetMeta(datasetIndex);
      if (meta.bar && this.chart.isDatasetVisible(datasetIndex)) {
        var stackIndex = stacks.indexOf(dataset.stack);
        if (stackIndex === -1) {
          stackIndex = stacks.length;
          stacks.push(dataset.stack);
        }
        meta.stackIndex = stackIndex;
      }
    }, this);

    this.getMeta().stacks = stacks;
    return stacks.length;
  },
});

var data = {
  labels: ['2016-03-14','2016-03-15','2016-03-16'],
			datasets: [
     
			  {
			  	label: \"A1\",
			  	backgroundColor: \"rgba(99,132,255,1)\",
			  	data: [29,42,36],
			  	stack: 'Stack 1'
			  },
			  {
			  	label: \"A2\",
			  	backgroundColor: \"#ff3333\",
			  	data: [10,0,5],
			  	stack: 'Stack 1'
			  },
			  {
			  	label: \"B1\",
			  	backgroundColor: \"#ffa64d\",
			  		data: [21,37,26],
			  	stack: 'Stack 2'
			  },
			  {
			  	label: \"B2\",
			  	backgroundColor: \"#ff3333\",
			  	data: [18,5,15],
			  	stack: 'Stack 2'
			  }
			],	
};

var ctx = document.getElementById(\"myChart6\").getContext(\"2d\");
new Chart(ctx, {
  type: 'groupableBar',
  data: data,
  options: {
  tooltips: {
            mode: 'x'
        },
        legend: {
            display: false
         },
  }
});


////////////////////////////////////////////////////////////////////


", View::POS_READY, 'my-options');

?>

<div class="site-index">

    <div class="body-content">
        <div class="panel-body">  
            <div class="row">   <!----------------------------------ROW1----------------------------------------->
                <div class="col-md-4"> <!--COLUMN1-->
                    <div class="panel panel-pink" >
                        <div class="panel-heading text-center"><h4><b>Line Chart</b></h4></div>
                        <div class="panel-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-4">  <!--COLUMN2-->
                    <div class="panel panel-pink" >
                        <div class="panel-heading text-center"><h4><b>Bar Chart</b></h4></div>
                        <div class="panel-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-4"> <!--COLUMN1-->
                    <div class="panel panel-pink" >
                        <div class="panel-heading text-center"><h4><b>Pie Chart</b></h4></div>
                        <div class="panel-body">
                            <canvas id="myChart3" style="height:159px;"></canvas>
                        </div>
                    </div>
                </div> 
            </div>   <!------------------------------------------------------------------------------->
            <div class="row">   <!----------------------------------ROW1----------------------------------------->
                <div class="col-md-4">  <!--COLUMN2-->
                    <div class="panel panel-pink" >
                        <div class="panel-heading text-center"><h4><b>Doughnut Chart</b></h4></div>
                        <div class="panel-body">
                            <canvas id="myChart4" style="height:159px;"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-4">  <!--COLUMN2-->
                    <div class="panel panel-pink" >
                        <div class="panel-heading text-center"><h4><b>Horizontal Bar Chart</b></h4></div>
                        <div class="panel-body">
                            <canvas id="myChart5" style="width=100px; height:245px;"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-4">  <!--COLUMN2-->
                    <div class="panel panel-pink" >
                        <div class="panel-heading text-center"><h4><b>Stack Bar Chart</b></h4></div>
                        <div class="panel-body">
                            <canvas id="myChart6" style="width=100px; height:245px;"></canvas>
                        </div>
                    </div>
                </div> 
            </div>   <!------------------------------------------------------------------------------->
        </div>
         


    </div>
</div>
