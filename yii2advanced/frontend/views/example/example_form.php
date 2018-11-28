<?php
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use kartik\datecontrol\DateControl;

$this->title = 'Example forms';
$this->params['breadcrumbs'][] = $this->title;

?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(['id' => 'form']); ?>
    
        <div class="panel-body">  
            <div class="row">   <!----------------------------------ROW1----------------------------------------->
                <div class="col-md-6"> <!--COLUMN1-->
                    <div class="panel panel-red" >
                        <div class="panel-heading"> <h5><b>Input fields</b></h5></div>
                        <div class="panel-body">
                            
                                <?= $form->field($model, 'text')->textInput(['autofocus' => true])->label('Text') ?>
                                <?= $form->field($model, 'text')->textarea()->label('Text area'); ?>
                                <?= $form->field($model, 'text')->passwordInput()->hint('Password must be character or number')->label('Password Hint') ?>
                                <?= $form->field($model, 'text')->listBox(
                                            array('1'=>'Item 1',2=>'Item 2',3=>'Item 3',4=>'Item 4',5=>'Item 5'),
                                            array(
                                                'disabled' => false,
                                                //'style'=>'background:gray;color:#fff;'
                                            ))->label('ListBox Field');
                                ?>

                                 <?= $form->field($model, 'text')->dropDownList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C'])->label('Dropdown List');
                // Format 2
                 //echo $form->field($model, 'text')->dropDownList($ArrayData,['prompt'=>'Choose...']); 
                 ?>

                <?php 
                        //Single Date picker
                        echo '<h5><b>Date Picker</b></h5>';
                        echo '<div class="input-group drp-container">';
                        /*echo $form->field($model, 'text')->widget(DateControl::classname(), [
                            'type'=>DateControl::FORMAT_DATE,
                            'ajaxConversion'=>false,
                            'widgetOptions' => [
                                'pluginOptions' => [
                                    'autoclose' => true
                                ]
                            ]
                        ]);*/
                        
                        //Date and Time Picker
                        echo '<h5><b>DateTime Picker</b></h5>';
                        echo '<div class="input-group drp-container">';
                        /*echo $form->field($model, 'datetime_1')->widget(DateControl::classname(), [
                            'type'=>DateControl::FORMAT_DATETIME
                        ]);*/
                ?>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6">  <!--COLUMN2-->
                <div class="panel panel-red" >
                        <div class="panel-heading"> <h5><b>Others</b></h5></div>
                        <div class="panel-body">
                                <div class="panel panel-red" >
                                    <div class="panel-heading"><h5><b>Upload</b></h5></div>
                                    <div class="panel-body">
                                        <?= $form->field($model, 'text')->fileInput()->label('File Upload') ?>
                                        <?= $form->field($model, 'text[]')->fileInput(['multiple'=>'multiple'])->label('Multiple File Upload'); ?>
                                    </div>
                                </div>
                                <div class="panel panel-red" >
                                    <div class="panel-heading"><h5><b>Checkbox</b></h5></div>
                                    <div class="panel-body">
                                        <h5><b>Checkbox</b></h5>
                                        <?= $form->field($model, 'text')->checkbox(array(
                                            'label'=>'Item',
                                            //'labelOptions'=>array('style'=>'padding:20px;'),
                                            'disabled'=>false
                                            )); 
                                        ?>
                
                                        <?= $form->field($model, 'text')->checkboxList(
                                            ['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']
                                            )->label('Multiple Checkbox');
                                        ?>
                                        <h5><b>Radio checkbox</b></h5>
                                        <?= $form->field($model, 'text')->radio(array(
                                                    'label'=>'',
                                                    //'labelOptions'=>array('style'=>'padding:20px;')
                                                    ));
                                        ?>
                                    </div>
                                </div>

                                <div class="panel panel-red" >
                                    <div class="panel-heading"><h5><b>Button</b></h5></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <?= Html::submitButton('Button', ['class' => 'btn btn-primary', 'name' => 'button'/*,'disabled' => 'disabled'*/]) ?>
                                            <?= Html::submitButton('Button', ['class' => 'btn btn-warning', 'name' => 'button'/*,'disabled' => 'disabled'*/]) ?>
                                            <?= Html::submitButton('Button', ['class' => 'btn btn-default', 'name' => 'button'/*,'disabled' => 'disabled'*/]) ?>
                                            <?= Html::submitButton('Button', ['class' => 'btn btn-danger', 'name' => 'button'/*,'disabled' => 'disabled'*/]) ?>
                                            <?= Html::submitButton('Button', ['class' => 'btn btn-success', 'name' => 'button'/*,'disabled' => 'disabled'*/]) ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
                </div> 
            </div>   <!------------------------------------------------------------------------------->
            <?php ActiveForm::end(); ?>
</div>