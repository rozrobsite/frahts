<?php
/* @var $this DefaultController */

//$this->adminBreadcrumbs=array(
//	'/admin/' => 'Главная',
//);
?>
<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-head tabs">
						<h3>Расположение</h3>
						<ul class="nav nav-tabs">
							<li class='active'>
								<a href="#0" data-toggle="tab">Страны</a>
							</li>
							<li>
								<a href="#1" data-toggle="tab">Регионы</a>
							</li>
							<li>
								<a href="#2" data-toggle="tab">Населенные пункты</a>
							</li>
						</ul>
					</div>
					<div class="box-content">
						<div class="tab-content">
							<div class="tab-pane active" id="0">
								<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
									'id'=>'country-add',
									'action' => '/admin/location',
									'htmlOptions'=>array('class'=>'well'),
								)); ?>

								<?php echo $form->textFieldRow($region, 'name_ru'); ?>
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
												'url' => $this->createUrl('/admin/location/edit'),
												'placement' => 'right',
//												'inputclass' => 'span3'
											)
										),
										array(
											'class'=>'bootstrap.widgets.TbButtonColumn',
											'template' => '{delete}',
											'htmlOptions'=>array('style'=>'width: 50px'),
										),
									),
								)); ?>
							</div>
							<div class="tab-pane" id="1">
								<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
									'id'=>'region-add',
									'action' => '/admin/location',
									'htmlOptions'=>array('class'=>'well'),
								)); ?>

								<?php echo $form->textFieldRow($region, 'name_ru'); ?>
								<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Добавить', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>

								<?php $this->endWidget(); ?>
								
								<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
									'id'=>'country-region-select',
									'action' => '/admin/location',
									'htmlOptions'=>array('class'=>'well'),
								)); ?>

								<?php echo CHtml::activeDropDownList($region, 'country_id', 
										$countries,
										array('empty' => 'Выберите страну'), 
										array());
								?>
								<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Показать', 'htmlOptions' => array('style' => 'margin-top: -10px'))); ?>

								<?php $this->endWidget(); ?>
								
								<?php $this->widget('bootstrap.widgets.TbGridView', array(
									'id' => 'region-list',
									'type'=>'striped bordered',
									'dataProvider'=>$region->search(),
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
												'url' => $this->createUrl('/admin/location/edit'),
												'placement' => 'right',
//												'inputclass' => 'span3'
											)
										),
										array(
											'class'=>'bootstrap.widgets.TbButtonColumn',
											'template' => '{delete}',
											'htmlOptions'=>array('style'=>'width: 50px'),
										),
									),
								)); ?>
							</div>
							<div class="tab-pane" id="2">Lorem ipsum sit sit magna cupidatat dolor irure dolore occaecat amet quis sed quis. Lorem ipsum ut laborum reprehenderit nostrud adipisicing in id minim. Lorem ipsum ad amet nostrud fugiat dolore dolore nulla non anim ullamco. Lorem ipsum sit reprehenderit ut deserunt minim proident cupidatat laboris cillum non do laboris velit reprehenderit do. Lorem ipsum cillum incididunt proident adipisicing reprehenderit culpa ad dolor. Lorem ipsum id ut pariatur commodo esse non. Lorem ipsum sit fugiat esse mollit irure elit. Lorem ipsum in officia est sint tempor elit deserunt dolore officia aliqua sunt in laborum eiusmod esse. </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
