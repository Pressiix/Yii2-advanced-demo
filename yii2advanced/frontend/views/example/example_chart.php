<?php
use common\assets\ChartJsAsset;
use yii\web\View;
use yii\helpers\Html;

$this->title = 'Example Chart.js';
$this->params['breadcrumbs'][] = $this->title;

ChartJsAsset::register($this);

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
        //maintainAspectRatio: false,
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
        //maintainAspectRatio: false,
    }
});
", View::POS_READY, 'my-options');

?>
    <div class="panel panel-red ">
        <div class="panel-heading text-center" style="margin-bottom : 20px;"><h1><b>Example Chart.js</b></h1></div>
        <div class="panel-body">  
            <div class="row">   <!----------------------------------ROW1----------------------------------------->
                <div class="col-md-6"> <!--COLUMN1-->
                    <div class="panel panel-red" >
                        <div class="panel-heading">Line Chart</div>
                        <div class="panel-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">  <!--COLUMN2-->
                    <div class="panel panel-red" >
                        <div class="panel-heading">Bar Chart</div>
                        <div class="panel-body">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div> 
            </div>   <!------------------------------------------------------------------------------->
            <div class="row">   <!----------------------------------ROW1----------------------------------------->
                <div class="col-md-6"> <!--COLUMN1-->
                    <div class="panel panel-red" >
                        <div class="panel-heading">Pie Chart</div>
                        <div class="panel-body">
                            <canvas id="myChart3"></canvas>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">  <!--COLUMN2-->
                    <div class="panel panel-red" >
                        <div class="panel-heading">Doughnnut Chart</div>
                        <div class="panel-body">
                            <canvas id="myChart4"></canvas>
                        </div>
                    </div>
                </div> 
            </div>   <!------------------------------------------------------------------------------->
        </div>
    </div>      
