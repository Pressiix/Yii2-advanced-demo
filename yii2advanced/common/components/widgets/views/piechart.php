<?php
use common\assets\ChartJsAsset;
use yii\web\View;

ChartJsAsset::register($this);
$this->registerJs(" 
var ctx = document.getElementById('$id').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: [".$labels."],
        datasets:[{
            label: \"My First Dataset\",
        backgroundColor: [".$backgroundColor."],
        borderColor: [".$borderColor."],
        data: [".$data."]
    }]
    },
    // Configuration options go here
    options: {
        responsive: false,
        maintainAspectRatio: true,
        legend: {
            display: ".$legend."
         },
    }
});

", View::POS_READY, $id.'-options');
?>
<canvas id="<?= $id; ?>" width="<?= $height; ?>" height="<?= $width; ?>"></canvas>
