<?php
/* @var $this MainAccountModelController */
/* @var $model MainAccountModel */
/* @var $form CActiveForm */
$this->menu = array(
		array(
				'label'=>"Generate Bulk",
				'url'=>'bulk'
			),
		// array(
		// 		'label'=>"Export All Accounts",
		// 		'url'=>'exportAll'
		// 	),
		// array(
		// 		'label'=>"Export All Main Accounts",
		// 		'url'=>'exportMain'
		// 	),
		// array(
		// 		'label'=>"Export All Sub Accounts",
		// 		'url'=>'exportSubAccount'
		// 	),
	);

?>

<div class="form">

<?php

$this->widget('bootstrap.widgets.TbAlert', array(
    'fade'=>true,
    'closeText'=>'×',
    'alerts'=>array(
	    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
	    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
    ),
)); 

?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'main-account-model-form-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<div></div>
	<?php echo $form->errorSummary($model); ?>
	<hr class='span9'>
	<div>
		<div class="span3" style="margin-left:24.828px">
			<?php echo CHtml::activeLabelEx($model, 'company_name'); ?>
			<?php echo CHtml::activeTextField($model, 'company_name'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'company_website'); ?>
			<?php echo CHtml::activeTextField($model, 'company_website'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'contact_person'); ?>
			<?php echo CHtml::activeTextField($model, 'contact_person'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'username'); ?>
			<?php echo CHtml::activeTextField($model, 'username'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'password'); ?>
			<?php echo CHtml::activeTextField($model, 'password'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'retype_password'); ?>
			<?php echo CHtml::activeTextField($model, 'retype_password'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'street'); ?>
			<?php echo CHtml::activeTextField($model, 'street'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'house_number'); ?>
			<?php echo CHtml::activeTextField($model, 'house_number'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'post_code'); ?>
			<?php echo CHtml::activeTextField($model, 'post_code'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'city'); ?>
			<?php echo CHtml::activeTextField($model, 'city'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'country'); ?>
			<?php echo CHtml::activeTextField($model, 'country'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'fax'); ?>
			<?php echo CHtml::activeTextField($model, 'fax'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'phone_number'); ?>
			<?php echo CHtml::activeTextField($model, 'phone_number'); ?>
		</div>
		<div class="span3">
			<?php echo CHtml::activeLabelEx($model, 'email_address'); ?>
			<?php echo CHtml::activeTextField($model, 'email_address'); ?>
		</div>		
	</div>
	<div class="clearfix"></div>
	<div class="row" style="margin-left :24.828px" >
		<hr class="span9">
		<?php echo CHtml::submitButton('Generate This Information',array('class'=>'btn btn-primary span9')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->