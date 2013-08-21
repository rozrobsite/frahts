<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-head">
						<h3>Добавление E-mail в базу</h3>
					</div>
					<div class="box-content">
						<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
							'id'=>'mailing-partial-send',
							'action' => '/admin/mailing/addMail',
							'htmlOptions'=>array('class'=>'well'),
						)); ?>

						<label>Добавьте e-mail (по одному в каждой строке):</label>
						<textarea id="emails" name="emails" style="width: 100%; min-height: 150px;"></textarea>

						<div style="width: 100%; text-align: right; margin-top: 25px;">
							<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Добавить в базу', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>
						</div>

						<?php if ($countAll): ?>
							<label>Отправлено <?php echo $countSended; ?> из <?php echo $countAll; ?></label>
						<?php endif; ?>

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