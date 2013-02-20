<?php if (Yii::app()->user->hasFlash('_success') || Yii::app()->user->hasFlash('_error')): ?>
	<?php 
		$message = ''; 
		if (Yii::app()->user->hasFlash('_success'))
			$message = Yii::app()->user->getFlash('_success');
		elseif (Yii::app()->user->hasFlash('_error'))
			$message = Yii::app()->user->getFlash('_success');
		else
			$message = 'Событие завершено.';
	
		echo '<script type="text/javascript">$.jGrowl("' . $message . '", { life: 10000 });</script>';
	?>
	
<?php endif; ?>