<?php 

?>
<div style="width:500px">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Generate Bulk',
		));
	?>
	<?php
		$this->widget('bootstrap.widgets.TbAlert', array(
		    'fade'=>true, 
		    'closeText'=>'×',
		    'alerts'=>array( 
			    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
			    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), 
		    ),
		    'htmlOptions'=>array()
		)); 
	?>
	<?php echo CHtml::beginForm(Yii::app()->request->requestUri, 'post'); ?>
		<?php echo CHtml::label('Number of item to generate', ''); ?>
		<?php echo CHtml::textField('numOfItems', 0); ?><br>
		<?php echo CHtml::button('Submit', array('class'=>'btn btn-primary','type'=>'submit')); ?><br>
	<?php echo CHtml::endForm(); ?>


	<?php
		$this->endWidget();
	?>
</div>