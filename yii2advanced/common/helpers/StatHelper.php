<?php
/**
 * Common helper
 * 
 * @author Watcharaphon Piamphuetna <watcharapon.piam@gmail.com>
 */
namespace common\helpers;

class StatHelper {

    public function Median($arr){
        sort($arr);
        $count = sizeof($arr);   // cache the count
        $index = floor($count/2);  // cache the index
        
           if($count & 1) {    // count is odd
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
        $mode = implode(",",array_keys($freq, max($freq)));

        return $mode;   
    }

    public function Range($arr){
        $range = (max($arr) - min($arr));

        return $range;
    }

    public function StandardDeviation($arr) 
    { 
        $num_of_elements = count($arr); 
          
        $variance = 0.0; 
            // calculating mean using array_sum() method 
        $average = array_sum($arr)/$num_of_elements; 
          
        foreach($arr as $i) 
        { 
            // sum of squares of differences between  
            // all numbers and means. 
            $variance += pow(($i - $average), 2); 
        } 
        $standard_deviation = (float)sqrt($variance/$num_of_elements); 

        return $standard_deviation;
    } 
}