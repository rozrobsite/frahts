<?php if (Yii::app()->user->hasFlash('vehicle_success') || Yii::app()->user->hasFlash('vehicle_error')): ?>
	<?php if (Yii::app()->user->hasFlash('vehicle_success')): ?>
		<div class="nNote nSuccess"><p><?php echo Yii::app()->user->getFlash('vehicle_success'); ?></p></div>
	<?php elseif (Yii::app()->user->hasFlash('vehicle_error')): ?>
		<div class="nNote nFailure hdn"><p><?php echo Yii::app()->user->getFlash('vehicle_error'); ?></p></div>
	<?php endif; ?>
	<div class="clear"></div>
<?php endif; ?>