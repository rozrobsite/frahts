<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs = array(
	'/admin/location' => 'Населенные пункты',
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
							'id' => 'region-add',
							'action' => '/admin/location/regions',
							'htmlOptions' => array('class' => 'form-horizontal'),
								));
						?>
						<div class="control-group">
							<?php
							echo CHtml::activeDropDownList($region, 'country_id', $countries,
									array('empty' => 'Выберите страну'), array());
							?>
							<?php echo $form->textField($region, 'name_ru', array('placeholder' => 'Введите название нового региона')); ?>
							<?php $this->widget('bootstrap.widgets.TbButton',
									array('buttonType' => 'submit', 'label' => 'Добавить')); ?>
						</div>

						<?php $this->endWidget(); ?>

						<?php
						$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
								array(
							'id' => 'country-region-select',
							'method' => 'get',
							'action' => '/admin/location/regions',
							'htmlOptions' => array('class' => 'form-horizontal'),
								));
						?>
						<div class="control-group">
							<?php
							echo CHtml::activeDropDownList($region, 'country_id', $countries,
									array('empty' => 'Выберите страну'), array());
							?>
							<?php $this->widget('bootstrap.widgets.TbButton',
									array('buttonType' => 'submit', 'label' => 'Показать')); ?>
						</div>

						<?php $this->endWidget(); ?>

						<?php
						$this->widget('bootstrap.widgets.TbGridView',
								array(
							'id' => 'region-list',
							'type' => 'striped bordered',
							'dataProvider' => $region->search(),
//									'filter' => $country,
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
									'name' => 'name_ru',
									'sortable' => true,
									'editable' => array(
										'url' => $this->createUrl('/admin/location/regionedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbButtonColumn',
									'template' => '{delete}',
									'buttons' => array(
										'delete' => array(
											'url'=>'Yii::app()->createUrl("admin/location/delete", array("id"=>$data->id, "type"=>"Region"))'
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