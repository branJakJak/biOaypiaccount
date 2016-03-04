<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <?php echo CHtml::link(Yii::app()->name, array('/site/index'), array('class'=>'brand')); ?>
          
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
                        array('label'=>'Home', 'url'=>array('/site/index')),
                        array('label'=>'Main Account', 'url'=>array('/mainAccount/create')),
                        array('label'=>'Sub Account', 'url'=>array('/subAccount/create')),
                        array('label'=>'Export <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"), 
                        'items'=>array(
                            array('label'=>'All ', 'url'=>array('mainAccount/exportAll')),
              							array('label'=>'Main(Active)', 'url'=>array('mainAccount/exportMain')),
              							array('label'=>'Subs ', 'url'=>array('mainAccount/exportSubAccount')),
                        )),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),

                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
            <?php echo CHtml::link('Clear all records', array('/deleteAll/main'), array('class'=>'btn btn-default','confirm'=>'Are you sure you want to delete all accounts?')); ?>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->