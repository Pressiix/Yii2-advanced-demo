<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
/**
 * 
 * @author Watcharaphon Piamphuetna <watcharapon.piam@gmail.com>
 *
 * Get valve status from NETPIE.io.
 */
class ValveStatus extends Model
{
    public $valve_info = [];

    public function getValveStatus()
    {
        $App = '/NETPIE2VALVE';
        $Topic = '/relaystat';
        $Key = 'WcTxK4EMocRJCcF';
        $Secret = 'H0AHhsFat0L0AIBmdmR3IhN6J';
        $valve_info = [];
        $is_connect = @fsockopen("www.google.com", 80);
        
        if($is_connect){
            $url = 'https://api.netpie.io/topic'. $App . $Topic .'?retain&auth='. $Key . ':' . $Secret;
            $response = \HttpFull\Request::get($url)->send();
                $result = json_decode($response->body, true);
                $valve_status = $result[0]['payload'];
                
                if($valve_status){
                    if($valve_status == '1'){
                            $valve_info['valve1_status_color'] = 'badge progress-bar-success';
                            $valve_info['valve2_status_color'] = 'badge progress-bar-primary';
                            $valve_info['valve1_status'] = 'On';
                            $valve_info['valve2_status'] = 'Off';
                    } 
                    if($valve_status == '2'){
                            $valve_info['valve1_status_color'] = 'badge progress-bar-primary';
                            $valve_info['valve2_status_color'] = 'badge progress-bar-success';
                            $valve_info['valve1_status'] = 'Off';
                            $valve_info['valve2_status'] = 'On';
                        }  
                        if($valve_status == '3'){
                            $valve_info['valve1_status_color'] = 'badge progress-bar-success';
                            $valve_info['valve2_status_color'] = 'badge progress-bar-success';
                            $valve_info['valve1_status'] = 'On';
                            $valve_info['valve2_status'] = 'On';
                        }  
                        if($valve_status == '4'){
                            $valve_info['valve1_status_color'] = 'badge progress-bar-primary';
                            $valve_info['valve2_status_color'] = 'badge progress-bar-primary';
                            $valve_info['valve1_status'] = 'Off';
                            $valve_info['valve2_status'] = 'Off';
                        }                                   
                }
                fclose($is_connect);
        }
        else{
            $valve_info['valve1_status_color'] = 'badge progress-bar-danger';
            $valve_info['valve2_status_color'] = 'badge progress-bar-danger';
            $valve_info['valve1_status'] = 'Can\'t connect';
            $valve_info['valve2_status'] = 'Can\'t connect';
        }
        
        return $valve_info;
    }
}