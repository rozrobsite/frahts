<?php if (Yii::app()->user->hasFlash('_success') || Yii::app()->user->hasFlash('_error')): ?>
	<?php if (Yii::app()->user->hasFlash('_success')): ?>
		<div class="nNote nSuccess"><p><?php echo Yii::app()->user->getFlash('_success'); ?></p></div>
	<?php elseif (Yii::app()->user->hasFlash('_error')): ?>
		<div class="nNote nFailure hdn"><p><?php echo Yii::app()->user->getFlash('_error'); ?></p></div>
	<?php endif; ?>
	<div class="clear"></div>
	
	<?php 
		$this->widget('application.extensions.PNotify.PNotify',array( 
			'message'=>'I am really a very simple notification')
	);
	?>
	
<?php endif; ?>