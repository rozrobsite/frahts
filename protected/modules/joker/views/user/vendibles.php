<?php
Yii::app()->clientScript->registerScriptFile('/js/joker/jokerVendibles.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->params['joker']['name'] . ' - Настройки (Товары для продажи)';
$this->breadcrumbs = array(
	'/joker/user' => 'Настройки',
	'/joker/organization' => 'Организация',
	'current' => 'Товары для продажи',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNavJoker') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('vendibles' => true))
		?>
	</div>
</div>

<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

        <?php
			$form = $this->beginWidget('CActiveForm',
					array(
						'id' => 'vendibles-form',
						'enableAjaxValidation' => false,
						'clientOptions' => array(
							'validateOnSubmit' => true,
						),
						'focus' => array($this->jokerUser->organizations->vendibles, 'name'),
						'htmlOptions' => array('class' => 'main'),
					));

        ?>
		<div class="fluid">
			<div class="widget grid12">
				<div class="whead">
					<h6>Добавить товар</h6>
					<div class="clear"></div>
				</div>
				<?php $this->renderPartial('/blocks/_atention'); ?>
				<div class="formRow">
					<div class="grid2"><label>Наименование:<span class="req">*</span></label></div>
					<div class="grid3">
                        <input id="name" name="JokerVendibles[name]" type="text" maxlength="254" />
						<div id="error_name" class="error"></div>
					</div>
					<div class="grid2">&nbsp;</div>
                    <div class="grid2"><label>Цена:<span class="req">*</span></label></div>
					<div class="grid3">
                        <input id="cost" name="JokerVendibles[cost]" type="text" maxlength="15" />
						<div id="error_cost" class="error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Краткое описание:<span class="req">*</span></label></div>
					<div class="grid10">
                        <input id="description" name="JokerVendibles[description]" type="text" maxlength="254" />
						<div id="error_description" class="error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<?php echo CHtml::submitButton('Добавить', array('class' => 'buttonM bBlue formSubmit')); ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
        <?php $this->endWidget(); ?>

		<?php $this->renderPartial('_listVendibles'); ?>
		<?php $this->renderPartial('/blocks/popups/_confirm', array(
            'title' => 'Удаление товара',
            'text' => 'Вы действительно хотите удалить даный товар?'
        )); ?>
    </div>
</div>

<!-- Content ends -->