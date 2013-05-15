<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs=array(
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
						<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
							'id'=>'news-add',
							'action' => '/admin/news/add',
							'htmlOptions'=>array('class'=>'well'),
						)); ?>

						<?php echo $form->textFieldRow($news, 'title'); ?>
						<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Добавить', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>

						<?php $this->endWidget(); ?>

						<?php $this->widget('bootstrap.widgets.TbGridView', array(
							'id' => 'make-list',
							'type'=>'striped bordered',
							'dataProvider'=>$make->search(),
							'filter' => $make,
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
									'name' => 'name',
									'sortable'=>true,
									'editable' => array(
										'url' => $this->createUrl('/admin/brendvehicle/makesedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbButtonColumn',
									'template' => '{delete}',
									'buttons' => array(
										'delete' => array(
											'url'=>'Yii::app()->createUrl("/admin/brendvehicle/delete", array("id"=>$data->id, "type"=>"Makes"))'
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