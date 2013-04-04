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
						<h3>Населенные пункты</h3>
					</div>
					<div class="box-content">
						<?php
						$form = $this->beginWidget('CActiveForm',
								array(
							'id' => 'city-add',
							'action' => '/admin/location/cities',
							'htmlOptions' => array('class' => 'form-horizontal'),
								));
						?>
						<div class="control-group">
							<?php
							echo CHtml::activeDropDownList($city, 'country_id', $countries,
									array('empty' => 'Выберите страну'), array());
							?>
							<?php
							echo CHtml::activeDropDownList($city, 'region_id', $regions,
									array('empty' => 'Выберите регион'), array());
							?>
							<?php echo $form->textField($city, 'name_ru', array('placeholder' => 'Название населенного пункта')); ?>
							<?php $this->widget('bootstrap.widgets.TbButton',
									array('buttonType' => 'submit', 'label' => 'Добавить')); ?>
						</div>

						<?php $this->endWidget(); ?>

						<?php
						$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
								array(
							'id' => 'country-region-select',
							'method' => 'get',
							'action' => '/admin/location/cities',
							'htmlOptions' => array('class' => 'form-horizontal'),
								));
						?>
						<div class="control-group">
							<?php
							echo CHtml::activeDropDownList($city, 'country_id', $countries,
									array('empty' => 'Выберите страну', 'submit' => '/admin/location/cities'));
							?>
							<?php
							echo CHtml::activeDropDownList($city, 'region_id', $regions,
									array('empty' => 'Выберите регион', 'submit' => '/admin/location/cities'));
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
							'dataProvider' => $city->search(),
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
										'url' => $this->createUrl('/admin/location/cityedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbEditableColumn',
									'name' => 'latitude',
									'sortable' => false,
									'editable' => array(
										'url' => $this->createUrl('/admin/location/cityedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbEditableColumn',
									'name' => 'longitude',
									'sortable' => false,
									'editable' => array(
										'url' => $this->createUrl('/admin/location/cityedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbButtonColumn',
									'template' => '{delete}',
									'buttons' => array(
										'delete' => array(
											'url'=>'Yii::app()->createUrl("admin/location/delete", array("id"=>$data->id, "type"=>"City"))'
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