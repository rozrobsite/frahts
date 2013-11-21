<?php
Yii::app()->clientScript->registerScriptFile('/js/files/jokerOrganizations.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->params['joker']['name'] . ' - Настройки (Организация)';
$this->breadcrumbs = array(
	'/joker/user' => 'Настройки',
	'current' => 'Организация',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNavJoker') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('organization' => true))
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

        <!-- Tabs -->
		<div class="fluid">
			<?php
			$form = $this->beginWidget('CActiveForm',
					array(
						'id' => 'organizations-form',
						'enableAjaxValidation' => false,
						'clientOptions' => array(
							'validateOnSubmit' => true,
						),
						'focus' => array($this->jokerUser->organizations, 'name'),
						'htmlOptions' => array('class' => 'main', 'enctype' => 'multipart/form-data'),
					));

			?>
			<div class="widget grid12">
				<div class="whead">
					<h6>Организация</h6>
					<div class="clear"></div>
				</div>
				<?php $this->renderPartial('/blocks/_atention'); ?>
				<div class="formRow">
					<div class="grid3"><label>Название организации:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'name') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'name', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label>Вид деятельности:<span class="req">*</span></label>
					</div>
					<div class="grid9">
						<?php echo CHtml::activeDropDownList($this->jokerUser->organizations, 'business_type_id', $typeOrganizations, array('empty' => 'Выберите вид деятельности')); ?>
						<?php echo $form->error($this->jokerUser->organizations, 'business_type_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label>Описание деятельности:<span class="req">*</span></label>
					</div>
					<div class="grid9">
						<?php echo $form->textArea($this->jokerUser->organizations, 'description', array('style' => 'height:150px;')) ?>
						<?php echo $form->error($this->jokerUser->organizations, 'description'); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid12"><h5>Местоположение Вашей организации</h5></div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Страна:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php echo CHtml::activeDropDownList($this->jokerUser->organizations, 'country_id', $countries, array('empty' => 'Выберите страну', 'class' => 'country', 'id' => 'jokerCountry'), array());?>
						<?php echo $form->error($this->jokerUser->organizations, 'country_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Регион:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php echo CHtml::activeDropDownList($this->jokerUser->organizations, 'region_id', $regions, array('empty' => 'Выберите регион', 'class' => 'region', 'id' => 'jokerRegion'), array());?>
						<?php echo $form->error($this->jokerUser->organizations, 'region_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Населенный пункт:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php echo CHtml::activeDropDownList($this->jokerUser->organizations, 'city_id', $regions, array('empty' => 'Выберите населенный пункт', 'class' => 'city', 'id' => 'jokerCity'), array());?>
						<?php echo $form->error($this->jokerUser->organizations, 'city_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid12"><h5>Контактные данные Вашей организации</h5></div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Телефон мобильный:<span class="req">*</span></label></div>
					<div class="grid9 onlyNums">
						<?php echo $form->textField($this->jokerUser->organizations, 'mobile') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'mobile', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Телефон/Факс:</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'phone') ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Электронный адрес (E-mail):</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'email') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'email', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Скайп (Skype):</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'skype') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'skype', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Сайт:</label></div>
					<div class="grid9">
						<?php echo $form->textField($this->jokerUser->organizations, 'site') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'site', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid8"><label>Скидка, которую вы предоставляете пользователям сайта:</label></div>
					<div class="grid4">
						<?php echo $form->textField($this->jokerUser->organizations, 'discount') ?>
						<?php echo $form->error($this->jokerUser->organizations, 'discount', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<?php echo CHtml::submitButton('Сохранить', array('class' => 'buttonM bBlue formSubmit')); ?>
					<div class="clear"></div>
				</div>

				<input type="hidden" id="latitude" value="ЧП <?php echo $this->jokerUser->organizations->latitude ?>" />
				<input type="hidden" id="longitude" value="ЧП <?php echo $this->jokerUser->organizations->longitude ?>" />

			</div>

			<div class="clear"></div>

			<?php $this->endWidget(); ?>

		</div>
    </div>
</div>

<!-- Content ends -->



