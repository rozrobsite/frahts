<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
		<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
							'id'=>'mailing-inputted-send',
							'action' => '/admin/mailing/inputtedMail',
							'htmlOptions'=>array('class'=>'well'),
						)); ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Рассылка по заданным E-mail</h3>
						</div>
						<div class="box-content">
							<label>Добавьте e-mail (по одному в каждой строке):</label>
							<textarea id="emails" name="emails" style="width: 100%; min-height: 150px;"></textarea>

							<lable>Тема рассылки:</lable>
							<input type="text" id="subject" name="subject" style="width: 100%;"/>
							<label>Текст рассылки:</label>
							<textarea id="text" name="text" style="width: 100%; min-height: 150px;" class="ckeditor"></textarea>

							<div style="width: 100%; text-align: right; margin-top: 25px;">
								<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Начать', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php $this->endWidget(); ?>
		<?php if (isset($countAll)): ?>
		<div class="row-fluid">
			<div class="span12">
				Всего введенных e-mail: <?php echo $countAll; ?><br/>
				Успешно отправленных: <?php echo $countSended; ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>