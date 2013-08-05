<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs=array(
	'/admin/emails' => 'E-mail',
);
?>
<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-head">
						<h3>Рассылка на все электронные адреса (E-mails)</h3>
					</div>
					<div class="box-content">
						<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
							'id'=>'mailing-add',
							'action' => '/admin/mailing/sendAll',
							'htmlOptions'=>array('class'=>'well'),
						)); ?>

						<?php echo $form->textFieldRow($mailingModel, 'subject', array('style' => 'width: 100%')); ?><br/>
						<?php echo $form->textareaRow($mailingModel, 'text', array('style' => 'width: 100%; min-height: 150px;')); ?><br/>

						<div style="width: 100%; text-align: right; margin-top: 25px;">
							<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Начать', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>
						</div>

						<?php $this->endWidget(); ?>

					</div>
				</div>
			</div>
		</div>
		<?php if (isset($count)): ?>
		<div class="row-fluid">
			<div class="span12">
				Всего доступных e-mail: <?php echo count($parserEmails) ?><br/>
				Успешно отправленных: <?php echo $count; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>