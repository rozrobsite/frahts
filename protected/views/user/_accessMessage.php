<?php if (!$this->is_access_search): ?>	<div class="nNote nInformation">		<p style="text-align: left;">			Для того что бы принять активное участие в поиске, пожалуйста, обязательно заполните следующие данные:<br/>			<?php if (!isset($this->user->profiles->id)): ?>				- Личный кабинет<br/>			<?php endif; ?>			<?php if (!isset($this->user->organizations->id)): ?>				- Организация<br/>			<?php endif; ?>			<?php if (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 1): ?>				- Добавьте транспорт			<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 2): ?>				- Добавьте груз			<?php elseif (isset($this->user->profiles->user_type_id) && $this->user->profiles->user_type_id == 3): ?>				- Добавьте транспорт или груз			<?php else: ?>				- Добавьте транспорт или груз			<?php endif; ?>		</p>	</div><?php endif; ?><?php if (Yii::app()->user->hasFlash('user_action_success') || Yii::app()->user->hasFlash('user_action_error')): ?>	<?php if (Yii::app()->user->hasFlash('user_action_success')): ?>		<div class="nNote nSuccess"><p><?php echo Yii::app()->user->getFlash('user_action_success'); ?></p></div>	<?php elseif (Yii::app()->user->hasFlash('user_action_error')): ?>		<div class="nNote nFailure hdn"><p><?php echo Yii::app()->user->getFlash('user_action_error'); ?></p></div>	<?php endif; ?>	<div class="clear"></div><?php endif; ?>