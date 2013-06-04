
<?php
/* @var $this DefaultController */
if (isset($model->id))
    $this->adminBreadcrumbs = array(
        '/admin/BodyType' . $model->slug => 'Список типов кузовов',
        '/admin/BodyType/edit' . $model->slug => 'Редактирование типа кузова',
    );
else
    $this->adminBreadcrumbs = array(
        '/admin/BodyType' . $model->slug => 'Список типов кузовов',
        '/admin/BodyType/add' => 'Добавление типа кузова',
    );
?>
<div class="container-fluid">
    <div class="content">
        <?php $this->renderPartial('/blocks/_quickstats'); ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="box-head">
                        <h3>Редактирование типа кузова</h3>
                    </div>
                    <div class="box-content">
                        <?php
                        $form = $this->beginWidget('CActiveForm',
                            array(
                                'id' => 'docs-add',
                                'action' => (isset($model->id) ? '/admin/BodyType/edit' . $model->id : '/admin/BodyType/add'),
                               // 'action' => '/admin/BodyType/edit',
                                'htmlOptions' => array('class' => 'form-horizontal'),
                            ));
                        ?>
                        <?php echo $form->labelEx($BodyType,' Новое имя типа кузова',array('font-size'=>'40px','text-align'=>'center'));?>
                        <?php echo $form->textField($BodyType,'name_ru'); ?>

                        <?php $this->widget('bootstrap.widgets.TbButton',array('buttonType'=>'submit','label'=>'Изменить'))?>

                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>