<?php 
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Html;

$form = ActiveForm::begin(); 
echo "
    <div class=\"container-fluid\">
        <div class=\"panel panel-body\">
";
?>
<?= 
	$form->field($model, 'product')->dropDownList($product_menu_list, [
		'prompt'=>'select product'
	]);     //Menu dropdown list
?>
<?=  $form->field($model, 'date')->widget(DatePicker::classname(),[
	'name' => 'datetime',
	'options' => ['placeholder' => 'select date','autocomplete' => 'off'],
	'pluginOptions' => [
		'format' => 'dd-M-yyyy',
		'todayHighlight' => true,
		'autoclose' => true,
	]
]);
?>
<div class="form-group">
<br/>
        <div>
            <?= Html::submitButton('Generate report', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); 
echo "
        </div>
    </div>
"; ?>