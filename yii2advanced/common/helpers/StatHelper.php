<?php
namespace common\helpers;

class StatHelper {

    public function getMedian($arr){
        sort($arr);
        $count = sizeof($arr);   // cache the count
        $index = floor($count/2);  // cache the index
        
            if (!$count) {
                $median = 0;
            } else if ($count & 1) {    // count is odd
                $median = $arr[$index];
            } else {                   // count is even
                $median = ($arr[$index-1] + $arr[$index]) / 2;
            }

        return $median;
    }
}