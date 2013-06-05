<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs = array(
    '/admin/PaymentType' => 'Типы кузовов',
);
?>
<div class="container-fluid">
    <div class="content">
        <?php $this->renderPartial('/blocks/_quickstats'); ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <h3>Курс валют</h3>
                    </div>
                    <div class="box-content">
                        <?php
                        $form = $this->beginWidget('CActiveForm',
                            array(
                                'id' => 'model-add',
                                'action' => '/admin/PaymentType/add',
                                'htmlOptions' => array('class' => 'form-horizontal'),
                            ));
                        ?>
                        <?php echo $form->labelEx($PaymentType,'Имя валюты',array('font-size','20px'));?>
                        <?php echo $form->textField($PaymentType,'name_ru'); ?>

                        <?php $this->widget('bootstrap.widgets.TbButton',array('buttonType'=>'submit','label'=>'Добавить валюту'))?>

                        <?php $this->endWidget(); ?>

                        <?php
                        $this->widget('bootstrap.widgets.TbGridView',
                            array(
                                'id' => 'model-list',
                                'type' => 'striped bordered',
                                'dataProvider' => $PaymentType->search(),
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
                                        'sortable'=>true,
                                        'editable' => array(
                                            'url' => $this->createUrl('/admin/PaymentType/editPaymentType'),
                                            'placement' => 'right',
                                        )
                                    ),
                                    array(
                                        'class' => 'bootstrap.widgets.TbButtonColumn',
                                        'template' => '{delete}',
                                        'buttons' => array(                                          
                                            'delete' => array(
                                                'url'=>'Yii::app()->createUrl("/admin/PaymentType/delete", array("id"=>$data->id, "type"=>"PaymentType","name_ru"=>$data->name_ru))'
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