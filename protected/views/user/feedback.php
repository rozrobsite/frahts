<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Обратная связь';
$this->breadcrumbs = array(
	'Обратная связь',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php
	$this->renderPartial('/blocks/mainNav',
			array('userFeedback' => $userFeedback))
	?>
</div>
<!-- Sidebar ends -->

<div id="content">
	<div class="wrapper">
		<?php
		$form = $this->beginWidget('CActiveForm',
				array(
			'action' => '/user/feedback',
			'id' => 'feedback-form',
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
			'htmlOptions' => array('class' => 'main'),
			'focus' => array($model, 'name'),
				));
		?>
		<fieldset>
			<div class="widget fluid">
				<div class="whead"><h6>Обратная связь</h6><div class="clear"></div></div>
				<div class="formRow">
					<div class="grid12">
						Если у Вас есть вопросы, предложения, пожелания, жалобы и Вы хотите связаться с нами, отправьте нам сообщение
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Тема сообщения:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php
							echo $form->textField($model, 'subject');
						?>
						<?php
							echo $form->error($model, 'subject', array('class' => 'error'));
						?>
					</div>

					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Напишите текст Вашего сообщения здесь:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php
							echo $form->textArea($model, 'message', array('class' => 'auto', 'rows' => 8));
						?>
						<?php
							echo $form->error($model, 'message', array('class' => 'error'));
						?>
					</div>
					<label id="error_feedback_text" for="feedback_text" generated="true" class="error center"></label>
					<div class="clear"></div>
				</div>
				<?php if (Yii::app()->user->hasFlash('feedback_success')): ?>
						<div class="nNote nSuccess"><p><?php echo Yii::app()->user->getFlash('feedback_success'); ?></p></div>
				<?php elseif (Yii::app()->user->hasFlash('feedback_failure')): ?>
						<div class="nNote nFailure hdn"><p><?php echo Yii::app()->user->getFlash('feedback_failure'); ?></p></div>
				<?php endif; ?>
				<div class="formRow">
					<div class="grid12" style="text-align: right">
				<?php
					echo CHtml::submitButton('Отправить',
							array('class' => 'buttonL bDefault mb10 mt5 feedback', 'style' => 'width: 15%;text-align: center;'));
				?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</fieldset>
		<?php $this->endWidget(); ?>
	</div>
</div>