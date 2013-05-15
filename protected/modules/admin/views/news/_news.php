<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs = array(
	'/admin/news' => 'Редактирование новостей',
);
?>
<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-head">
						<h3>Добавление новости</h3>
					</div>
					<div class="box-content">
						<?php
						$form = $this->beginWidget('CActiveForm',
								array(
									'id' => 'news-add',
									'action' => '/admin/news/add',
									'htmlOptions' => array('class' => 'form-horizontal'),
								));
						?>

						<div class="control-group">
							<label for="basic" class="control-label">Название новости</label>
							<div class="controls">
								<?php echo $form->textField($model, 'title', array('style' => 'width: 90%')); ?>
								<?php echo $form->error($model, 'title', array('class' => 'error'));
								?>
							</div>
						</div>
						<div class="box">
							<div class="box-head">
								<h3 style="margin: 0; line-height: 20px;">Текст новости</h3>
							</div>
							<div class="box-content box-nomargin" style="min-height: 400px;">
								<!--<textarea name="a" class='span12 cleditor'></textarea>-->
								<?php echo $form->textArea($model, 'text', array('class' => 'span12 cleditor')) ?>
								<?php echo $form->error($model, 'text'); ?>
							</div>
						</div>
						<div class="form-actions">
							<?php
								echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить',
										array(
											'class' => 'btn btn-primary',
											'style' => 'float:right',
										));
							?>
						</div>
						<?php $this->endWidget(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>