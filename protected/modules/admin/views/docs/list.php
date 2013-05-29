<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs=array(
	'/admin/location' => 'Список документов',
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
						<?php $this->widget('bootstrap.widgets.TbGridView', array(
							'id' => 'docs-list',
							'type'=>'striped bordered',
							'dataProvider'=>$model->search(),
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
								array(
									'name' => 'id',
									'htmlOptions' => array(
										'style' => 'text-align: center',
									),
								),
								array(
									'class' => 'bootstrap.widgets.TbEditableColumn',
									'name' => 'title',
									'sortable'=>true,
									'editable' => array(
										'url' => $this->createUrl('/admin/docs/titleedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									),
									'htmlOptions' => array(
										'style' => 'text-align: center',
									),
								),
								array(
									'name' => 'created_at',
									'sortable'=>true,
									'value' => function($data, $row) {
										return date('d.m.Y', $data->created_at);
									},
									'htmlOptions' => array(
										'style' => 'text-align: center',
									),
								),
								array(
									'class' => 'bootstrap.widgets.TbEditableColumn',
									'name' => 'slug',
									'sortable'=>true,
									'editable' => array(
										'url' => $this->createUrl('/admin/docs/slugedit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									),
									'htmlOptions' => array(
										'style' => 'text-align: center',
									),
								),
								array(
									'class' => 'bootstrap.widgets.TbButtonColumn',
									'template' => '{update}{delete}',
									'buttons' => array(
										'delete' => array(
											'url'=>'Yii::app()->createUrl("admin/docs/delete", array("id"=>$data->id, "type"=>"Docs"))'
										),
										'update' => array(
											'url'=>'Yii::app()->createUrl("admin/docs/edit", array("id"=>$data->id, "type"=>"Docs"))'
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