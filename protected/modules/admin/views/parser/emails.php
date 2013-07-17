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
						<h3>Электронные адреса (E-mails)</h3>
					</div>
					<div class="box-content">
						<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
							'id'=>'email-add',
							'action' => '/admin/parser/emails',
							'htmlOptions'=>array('class'=>'well'),
						)); ?>

						<?php echo $form->textFieldRow($parserEmails, 'email'); ?>
						<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Добавить', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>

						<?php $this->endWidget(); ?>

						<?php $this->widget('bootstrap.widgets.TbGridView', array(
							'id' => 'emails-list',
							'type'=>'striped bordered',
							'dataProvider'=>$parserEmails->search(),
							'filter' => $parserEmails,
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
									'name' => 'email',
									'sortable'=>true,
									'editable' => array(
										'url' => $this->createUrl('/admin/parser/emailEdit'),
										'placement' => 'right',
//												'inputclass' => 'span3'
									)
								),
								array(
									'class' => 'bootstrap.widgets.TbButtonColumn',
									'template' => '{delete}',
									'buttons' => array(
										'delete' => array(
											'url'=>'Yii::app()->createUrl("/admin/parser/delete", array("id"=>$data->id))'
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