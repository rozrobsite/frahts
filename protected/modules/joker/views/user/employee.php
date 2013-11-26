<?php
Yii::app()->clientScript->registerScriptFile('/js/files/jokerEmployee.js', CClientScript::POS_BEGIN);

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
					<div class="grid3"><label>ФИО:<span class="req">*</span></label></div>
					<div class="grid9">
                        <input id="jokerFio" type="text" maxlength="254" />
						<div id="errorFio" class="error">Введите ФИО</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label>Должность (отдел):<span class="req">*</span></label>
					</div>
					<div class="grid9">
						<select multiple="multiple" class="fullwidth select" data-placeholder="Выберите из списка кликнув сюда" name="JokerOrganizations[business_types][]">
							<option value=""></option>
							<?php foreach ($typeOrganizations as $typeOrganization): ?>
									<option value="<?php echo $typeOrganization->id; ?>" <?php if ($this->jokerUser->organizations->hasBusinessType(
                                        $typeOrganization->id)): ?>selected="selected"<?php endif; ?>>
										<?php echo $typeOrganization->name; ?>
									</option>
							<?php endforeach; ?>
						</select>
						<?php echo $form->error($this->jokerUser->organizations, 'business_types', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label>Описание деятельности:<span class="req">*</span></label>
					</div>
					<div class="grid9">
						<?php echo $form->textArea($this->jokerUser->organizations, 'description', array('style' => 'height:150px;')) ?>
						<?php echo $form->error($this->jokerUser->organizations, 'description', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<!-- Content ends -->



