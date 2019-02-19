<?php
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
//use kartik\datecontrol\DateControl;

$this->title = 'Example forms';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['id' => 'form']); ?>
<?= $form->field($model, 'name', [
            'template' => '<div class="input-group"><span class="input-group-addon glyphicon glyphicon-user"></span>{input}</div>'])
            ->dropDownList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C'])->label('Name'); ?>
<?= '<label class="control-label">Date</label>'; ?>
<?= DatePicker::widget([
	'name' => 'date', 
    'value' => date('d-M-Y'),
    
	'options' => ['placeholder' => 'Select issue date ...'],
	'pluginOptions' => [
		'format' => 'dd-M-yyyy',
		'todayHighlight' => true
	]
]); ?>
<?php ActiveForm::end(); ?>