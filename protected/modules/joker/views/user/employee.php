<?php
Yii::app()->clientScript->registerScriptFile('/js/joker/jokerEmployee.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->params['joker']['name'] . ' - Настройки (Организация)';
$this->breadcrumbs = array(
	'/joker/user' => 'Настройки',
	'/joker/organization' => 'Организация',
	'current' => 'Сотрудники',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNavJoker') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('employee' => true))
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
						'id' => 'employee-form',
						'enableAjaxValidation' => false,
						'clientOptions' => array(
							'validateOnSubmit' => true,
						),
						'focus' => array($this->jokerUser->organizations->employees, 'position'),
						'htmlOptions' => array('class' => 'main'),
					));

        ?>
		<div class="fluid">
			<div class="widget grid12">
				<div class="whead">
					<h6>Добавить сотрудника</h6>
					<div class="clear"></div>
				</div>
				<?php $this->renderPartial('/blocks/_atention'); ?>
				<div class="formRow">
					<div class="grid2"><label>ФИО:<span class="req">*</span></label></div>
					<div class="grid3">
                        <input id="fio" name="JokerEmployee[fio]" type="text" maxlength="254" />
						<div id="error_fio" class="error"></div>
					</div>
					<div class="grid2">&nbsp;</div>
					<div class="grid2"><label>Должность(отдел):<span class="req">*</span></label></div>
					<div class="grid3">
                        <input id="position" name="JokerEmployee[position]" type="text" maxlength="254" />
						<div id="error_position" class="error"></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid2"><label>Телефон мобильный:<span class="req">*</span></label></div>
					<div class="grid3 onlyNums">
                        <input id="mobile" name="JokerEmployee[mobile]" type="text" maxlength="15" />
						<div id="error_mobile" class="error"></div>
					</div>
					<div class="grid2">&nbsp;</div>
					<div class="grid2"><label>Электронный алрес (E-mail):<span class="req">*</span></label></div>
					<div class="grid3">
                        <input id="email" name="JokerEmployee[email]" type="text" maxlength="254" />
						<div id="error_email" class="error"></div>
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

		<?php $this->renderPartial('_listEmployee'); ?>
		<?php $this->renderPartial('/blocks/popups/_confirm', array(
            'title' => 'Удаление сотрудника',
            'text' => 'Вы действительно хотите удалить даного сотрудника?'
        )); ?>
    </div>
</div>

<!-- Content ends -->



