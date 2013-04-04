<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs = array(
	'/admin/brendvehicle' => 'Марки и модели',
);
?>
<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-head">
						<h3>Регионы</h3>
					</div>
					<div class="box-content">
						<?php
						$form = $this->beginWidget('CActiveForm',
								array(
							'id' => 'model-add',
							'action' => '/admin/brendvehicle/models',
							'htmlOptions' => array('class' => 'form-horizontal'),
								));
						?>
						<div class="control-group">
							<?php
							echo CHtml::activeDropDownList($model, 'make_id', $makes,
									array('empty' => 'Выберите марку'), array());
							?>
							<?php echo $form->textField($model, 'name', array('placeholder' => 'Введите название новой модели')); ?>
							<?php $this->widget('bootstrap.widgets.TbButton',
									array('buttonType' => 'submit', 'label' => 'Добавить')); ?>
						</div>

						<?php $this->endWidget(); ?>

						<?php
						$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
								array(
							'id' => 'makes-models-select',
							'method' => 'get',
							'action' => '/admin/brendvehicle/models',
							'htmlOptions' => array('class' => 'form-horizontal'),
								));
						?>
						<div class="control-group">
							<?php
							echo CHtml::activeDropDownList($model, 'make_id', $makes,
									array('empty' => 'Выберите марку'), array());
							?>
							<?php $this->widget('bootstrap.widgets.TbButton',
									array('buttonType' => 'submit', 'label' => 'Показать')); ?>
						</div>

						<?php $this->endWidget(); ?>

						<?php
						$this->widget('bootstrap.widgets.TbGridView',
								array(
							'id' => 'model-list',
							'type' => 'striped bordered',
							'dataProvider' => $model->search(),
//							'filter' => $model,
							'template' => '{summary}{items}{pager}',
							'enablePagination' => true,
							'pager' => array(
								'header' => '',
								'cssFile' => false,
								'maxButtonCount' => 10,
								'selectedPageCssClass' => 'active',
								'hiddenPageCssClass' => 'disabled',
								'firstPageCssClass' => 'previous',
								'lastPageCssClass' => 'next',
								'firstPageLabel' => '<<',
								'lastPageLabel' => '>>',
								'prevPageLabel' => '<',
								'nextPageLabel' => '>',
							),
							'columns' => array(
								'id',
								array(
									'class' => 'bootstrap.widgets.TbEditableColumn',
									'name' => 'name',
									'sortable' => true,
									'editable' => array(
										'url' => $this->createUrl('/admin/brendvehicle/modelsedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbButtonColumn',
									'template' => '{delete}',
									'buttons' => array(
										'delete' => array(
											'url'=>'Yii::app()->createUrl("/admin/brendvehicle/delete", array("id"=>$data->id, "type"=>"Models"))'
										),
									)
								),
							),
						));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>