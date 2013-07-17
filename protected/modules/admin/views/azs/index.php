<?php
/* @var $this DefaultController */

$this->adminBreadcrumbs = array(
    '/admin/Currency' => 'Парсеры для АЗС',
);
?>
<div class="container-fluid">
    <div class="content">
        <?php $this->renderPartial('/blocks/_quickstats'); ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <h3>АЗС</h3>
                    </div>
                    <div class="box-content">
                        <?php
                        $form = $this->beginWidget('CActiveForm',
                            array(
                                'id' => 'model-azs',
                                'action' => '/admin/azs/update',
                                'htmlOptions' => array('class' => 'form-horizontal'),
                            ));
                        ?>

                        <?php //$this->widget('bootstrap.widgets.TbButton',array('buttonType'=>'submit','label'=>'Запустить парсер'))?>

                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>