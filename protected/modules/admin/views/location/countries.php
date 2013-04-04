<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs=array(
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
						<h3>Страны</h3>
					</div>
					<div class="box-content">
						<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
							'id'=>'country-add',
							'action' => '/admin/location/countries',
							'htmlOptions'=>array('class'=>'well'),
						)); ?>

						<?php echo $form->textFieldRow($country, 'name_ru'); ?>
						<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Добавить', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>

						<?php $this->endWidget(); ?>

						<?php $this->widget('bootstrap.widgets.TbGridView', array(
							'id' => 'country-list',
							'type'=>'striped bordered',
							'dataProvider'=>$country->search(),
//									'filter' => $country,
							'template'=>'{summary}{items}{pager}',
							'enablePagination' => true,
							'pager'=>array(
									'header'=>'',
									'cssFile'=>false,
									'maxButtonCount'=>10,
									'selectedPageCssClass'=>'active',
									'hiddenPageCssClass'=>'disabled',
									'firstPageCssClass'=>'previous',
									'lastPageCssClass'=>'next',
									'firstPageLabel'=>'<<',
									'lastPageLabel'=>'>>',
									'prevPageLabel'=>'<',
									'nextPageLabel'=>'>',
							),
							'columns'=>array(
								'id',
								array(
									'class' => 'bootstrap.widgets.TbEditableColumn',
									'name' => 'name_ru',
									'sortable'=>true,
									'editable' => array(
										'url' => $this->createUrl('/admin/location/countryedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbButtonColumn',
									'template' => '{delete}',
									'buttons' => array(
										'delete' => array(
											'url'=>'Yii::app()->createUrl("admin/location/delete", array("id"=>$data->id, "type"=>"Country"))'
										),
									)
								),
							),
						)); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
