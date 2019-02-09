<?php
use aki\imageslider\ImageSlider;
use common\assets\FullCalendarAsset;
//use common\assets\DataTableAsset;
use yii\web\View;
FullCalendarAsset::register($this);
//DataTableAsset::register($this);
$this->title = 'Frontend';
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
        height: 370    //set calendar high
    });

});

/**********************************DataTable Configuration*********************************************/
/*$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf'
        ],
        \"paging\": false,
        \"info\":     false
    } );
} );*/
/******************************************************************************************************/
", View::POS_READY, 'my-options');
?>
<div class="site-index">
    <i class="fa fa-camera-retro fa-5x"></i>
    <div class="body-content">
    <?= ImageSlider::widget([
	'baseUrl' => Yii::getAlias('@web/image'),
    'nextPerv' => true,
    'indicators' => true,
    'height' => '330px',
    'width' => '100%',
    'classes' => 'img-rounded',
    'images' => [
        [
            'active' => true,
            'src' => '1.jpg',
            'title' => 'image',

        ],
        [
            'src' => '2.jpg',
            'title' => 'image',
        ],
        [
            'src' => 'b1.jpg',
            'title' => 'image',

        ],
        [
            'src' => 'b2.jpg',
            'title' => 'image',
        ]/*,
        [
            'src' => '1.jpg',
            'title' => 'image',

        ],
        [
            'src' => '2.jpg',
            'title' => 'image',
        ]*/
    ],
    ]); ?>
    <br/>
            <div class="row">   <!----------------------------------ROW1----------------------------------------->
                <div class="col-md-2"> <!--COLUMN1-->
                    <div class="panel panel-red" style="height:222px;" >
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
                    <div class="panel panel-red" style="height:200px;">
                    <div class="panel-heading text-center"><b>Valve status</b></div>
                            <div class="panel-body">
                            <table class="table text-center">
                                    <thead>
                                        <tr>
                                        <th scope="col" class="text-center">Valve NO.</th>
                                        <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><span class="<?= $valve_info['valve1_status_color'] ?>"><?= $valve_info['valve1_status'] ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><span class="<?= $valve_info['valve2_status_color'] ?>"><?= $valve_info['valve2_status'] ?></span></td>
                                        </tr>
                                        <!--<tr>
                                        <td> ?= $med ? </td> </tdmed>
                                        </tr>-->
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="col-md-7">  <!--COLUMN2-->
                    <div class="panel panel-red" >
                        <div class="panel-heading text-center"><b>News</b></div>
                        <div class="panel-body" style="height:400px;">
                        <table id="example" class="table table-hover">
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
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y") ?></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y") ?></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y",strtotime("yesterday")) ?></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y",strtotime("-3 day")) ?></td>
                                </tr>
                                <tr>
                                    <td> <span class="badge progress-bar-info">New</span></td>
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y") ?></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y") ?></td>
                                </tr>
                                <tr>
                                    <td> <span class="badge progress-bar-info">New</span></td>
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y",strtotime("-5 day")) ?></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>Demo topic</td>
                                    <td class="text-center"><?= date("d/m/Y") ?></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div> 
                <div class="col-md-3">  <!--COLUMN3-->
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
