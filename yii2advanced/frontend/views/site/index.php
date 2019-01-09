<?php
use aki\imageslider\ImageSlider;
//use segpacto\yii2-httpfull;
use common\assets\FullCalendarAsset;
use yii\web\View;
//use common\assets\FontawesomeAsset;
/* @var $this yii\web\View */
FullCalendarAsset::register($this);
//FontawesomeAsset::register($this);
$this->title = 'Frontend';

/*------------------------------------NETPIE VALVE STATUS------------------------------------ */
$uri = 'https://api.netpie.io/topic/NETPIE2VALVE/relaystat?retain&auth=WcTxK4EMocRJCcF:H0AHhsFat0L0AIBmdmR3IhN6J';
$response = \HttpFull\Request::get($uri)->send();
$result = json_decode($response->body, true);
$valve_status = $result[0]['payload'];

$valve_status_color1 = '';
$valve_status_color2 = '';
$valve_status_text1 = '';
$valve_status_text2 = '';
  if($valve_status){
       if($valve_status == '1'){
            $valve_status_color1 = 'badge progress-bar-success';
            $valve_status_color2 = 'badge progress-bar-primary';
            $valve_status_text1 = 'On';
            $valve_status_text2 = 'Off';
       } 
       if($valve_status == '2'){
            $valve_status_color1 = 'badge progress-bar-primary';
            $valve_status_color2 = 'badge progress-bar-success';
            $valve_status_text1 = 'Off';
            $valve_status_text2 = 'On';
        }  
        if($valve_status == '3'){
            $valve_status_color1 = 'badge progress-bar-success';
            $valve_status_color2 = 'badge progress-bar-success';
            $valve_status_text1 = 'On';
            $valve_status_text2 = 'On';
        }  
        if($valve_status == '4'){
            $valve_status_color1 = 'badge progress-bar-primary';
            $valve_status_color2 = 'badge progress-bar-primary';
            $valve_status_text1 = 'Off';
            $valve_status_text2 = 'Off';
        }                                   
  }

/*---------------------------------------------------------------------------------------------------------------- */
$this->registerJs(" 
$(document).ready(function() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    } 
    
    if(mm<10) {
        mm = '0'+mm
    } 

    today = mm + '/' + dd + '/' + yyyy;

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        defaultDate: today,
        defaultView: 'month',
        editable: true,
        events: [
            {
                title: 'All Day Event',
                start: '2018-12-15'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2018-12-09T16:00:00'
            },
            {
                title: 'Test Link',
                url: 'http://google.com/',
                start: '2018-12-28'
            }
        ],
        height: 390    //set calendar high
    });

});

", View::POS_READY, 'my-options');
?>
<div class="site-index">

    <!--<div class="jumbotron">
        <h1>Hello World!!</h1>
    </div>-->
    <i class="fa fa-camera-retro fa-5x"></i>
    <div class="body-content">
    <?= ImageSlider::widget([
	'baseUrl' => Yii::getAlias('@web/image'),
    'nextPerv' => true,
    'indicators' => true,
    'height' => '320px',
    'width' => '100%',
    'classes' => 'img-rounded',
    'images' => [
        [
            'active' => true,
            'src' => 'b1.jpg',
            'title' => 'image',

        ],
        [
            'src' => 'b2.jpg',
            'title' => 'image',
    	],
        [
            'src' => 'b1.jpg',
            'title' => 'image',

        ],
        [
            'src' => 'b2.jpg',
            'title' => 'image',
        ],
        [
            'src' => 'b1.jpg',
            'title' => 'image',

        ],
        [
            'src' => 'b2.jpg',
            'title' => 'image',
        ]
    ],
    ]); ?>
    <br/>
            <div class="row">   <!----------------------------------ROW1----------------------------------------->
                <div class="col-md-2"> <!--COLUMN1-->
                    <div class="panel panel-red" style="width:100%; height:245px;" >
                        <div class="panel-heading text-center"><b>Online users</b></div>
                            <div class="panel-body">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                        <th scope="col" class="text-center">Name</th>
                                        <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Mark</td>
                                            <td><span class="badge progress-bar-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Jacob</td>
                                            <td><span class="badge progress-bar-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>Larry</td>
                                            <td><span class="badge progress-bar-primary">Inactive</span></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-red" style="width:100%; height:200px;">
                            <div class="panel-body">
                            <table class="table text-center">
                                    <thead>
                                        <tr>
                                        <th scope="col" class="text-center">Valve name</th>
                                        <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Valve 1</td>
                                            <td><span class="<?= $valve_status_color1 ?>"><?= $valve_status_text1 ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Valve 2</td>
                                            <td><span class="<?= $valve_status_color2 ?>"><?= $valve_status_text2 ?></span></td>
                                        </tr>
                                        
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="col-md-7">  <!--COLUMN2-->
                    <div class="panel panel-red" >
                        <div class="panel-heading text-center"><b>News</b></div>
                        <div class="panel-body" style="height:420px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col" style="width:50px;"></th>
                                <th scope="col" style="width:300px;">Topics</th>
                                <th scope="col" class="text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <span class="badge progress-bar-info">New</span></td>
                                    <td> Avengers 4 aaaaaaaaaaaaaaaaaaa</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> Topic 2</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> Arghhhhhhh</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> Topic 3</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                                <tr>
                                    <td> <span class="badge progress-bar-info">New</span></td>
                                    <td> Avengers 4 aaaaaaaaaaaaaaaaaaa</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> Topic 4</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                                <tr>
                                    <td> <span class="badge progress-bar-info">New</span></td>
                                    <td> Avengers 4 aaaaaaaaaaaaaaaaaaa</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> Avengers 4 aaaaaaaaaaaaaaaaaaa</td>
                                    <td class="text-center">11/12/2018</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div> 
                <div class="col-md-3">  <!--COLUMN2-->
                    <div class="panel panel-red" >
                        <div class="panel-heading text-center"><b>Calendar</b></div>
                        <div class="panel-body">
                            <!---------------------------------------------------------->
                            <div id='calendar'></div>
                            <!---------------------------------------------------------->
                        </div>
                    </div>
                </div> 
            </div>   <!-------------------------------------------------------------------------------> 
    </div>
</div>
