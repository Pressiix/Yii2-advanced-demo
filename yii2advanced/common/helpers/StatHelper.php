<?php
namespace common\helpers;

class StatHelper {

    public function Median($arr){
        sort($arr);
        $count = sizeof($arr);   // cache the count
        $index = floor($count/2);  // cache the index
        
            if (!$count) {
                $median = 0;
            } 
            else if($count & 1) {    // count is odd
                $median = $arr[$index];
            } 
            else{                   // count is even
                $median = ($arr[$index-1] + $arr[$index]) / 2;
            }

        return $median;
    }

    public function Average($arr){
            $average = array_sum($arr) / count($arr);

        return $average;
    }

    public function Mode($arr){
        $freq = [];

        for($i=0; $i<count($arr); $i++)
        {
            if(isset($freq[$arr[$i]])==false){
                $freq[$arr[$i]] = 1;
            }
            else{
                $freq[$arr[$i]]++;
            }
        }
        $mode_array = array_keys($freq, max($freq));

        if(count($mode_array) > 1){
            for($j=0; $j< count($mode_array); $j++){
                $mode = 
            }
        }

        return $mode;   //return array 
    }

    public function Range($arr){
        $range = (max($arr) - min($arr));

        return $range;
    }
}