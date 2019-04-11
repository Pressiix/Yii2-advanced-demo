<?php
/**
 * Copyright : Watcharaphon Piamphuetna 
 * Email : watcharapon.piam@gmail.com
 * */
/**EXAMPLE 
 * use common\components\widgets\PieChartWidget;
 *  <?= PieChartWidget::widget([
 *          'labels' => ['A','B','C'],
 *          'data' => [1,2,3],
 *          'backgroundColor' => ['#f6546a','#40e0d0','#ffc125'],
 *          'borderColor' => ['#f6546a','#40e0d0','#ffc125'],
 *          'height' => '100px',
 *          'width' => '100px',
 *          'legend' => 'false'
 *      ]) 
 * ?> 
 * */
namespace common\components\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class PieChartWidget extends Widget{
    public $id;
    public $labels;
    public $data;
    public $backgroundColor;
    public $borderColor;
    public $height;
    public $width;
    public $legend;
    public function init()
    {
        parent::init();
        
    }

    public function run()
    {
        $this->labels = "'".implode("','",$this->labels)."'";
        $this->data = "'".implode("','",$this->data)."'";
        $this->backgroundColor = "'".implode("','",$this->backgroundColor)."'";
        $this->borderColor = "'".implode("','",$this->borderColor)."'";
        
        return $this->render('piechart',[
            'id' => $this->id,
            'labels' => $this->labels,
            'data' => $this->data,
            'backgroundColor' => $this->backgroundColor,
            'borderColor' => $this->borderColor,
            'height' => $this->height,
            'width' => $this->width,
            'legend' => $this->legend
        ]);
    }
}
?>