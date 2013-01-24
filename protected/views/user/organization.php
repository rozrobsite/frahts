<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Настройки пользователя (Организация)';
$this->breadcrumbs = array(
	'Настройки пользователя (Организация)',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php $this->renderPartial('_secWrapper',
				array('selectOrganization' => true)) ?>
	</div>
</div>
<!-- Sidebar ends -->
<!-- Sidebar ends -->
<div id="content">
<?php $this->renderPartial('/blocks/contentTop') ?>

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="/user">Настройки пользователя</a></li>
                <li class="current"><a title="">Организация</a></li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('_accessMessage') ?>
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
				'focus' => array($model, 'user_type_id'),
				'htmlOptions' => array('class' => 'main', 'enctype' => 'multipart/form-data'),
					));
			?>
			<div class="widget grid12">     
				<div class="whead">
					<h6>Организация</h6>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Форма регистрации:<span class="req">*</span></label></div>
					<div class="grid9">
						<?php echo CHtml::activeDropDownList($model, 'type_org_id', $typeOrganizations); ?>
						<?php echo $form->error($model, 'type_org_id', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label>Форма налогообложения:<span class="req">*</span></label>
					</div>
					<div class="grid9">
						<?php echo $form->textField($model, 'form_tax') ?>
						<?php echo $form->error($model, 'form_tax', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Название организации:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'name_org') ?>
						<?php echo $form->error($model, 'name_org', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Лицензия:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'license') ?>
						<?php echo $form->error($model, 'license', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label id="private_label"
							   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_CORPORATE): ?>display: none<?php endif; ?>">
							Адрес регистрации:
						</label>
						<label id="corporate_label" 
							   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_PRIVATE): ?>display: none<?php endif; ?>">
							Юридический адресс:
						</label>
					</div>
					<div class="grid9">
						<?php echo $form->textField($model, 'address') ?>
						<?php echo $form->error($model, 'address', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div id="edrpou" class="formRow" 
					 style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_PRIVATE): ?>display: none<?php endif; ?>">
					<div class="grid3">
						<label>Код ЕДРПОУ:</label>
					</div>
					<div class="grid9">
						<?php echo $form->textField($model, 'edrpou') ?>
						<?php echo $form->error($model, 'edrpou', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>№ счета:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'account_number') ?>
						<?php echo $form->error($model, 'account_number', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>В каком банке:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'bank') ?>
						<?php echo $form->error($model, 'bank', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>В каком городе:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'city') ?>
						<?php echo $form->error($model, 'city', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>МФО:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'mfo') ?>
						<?php echo $form->error($model, 'mfo', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>ИНН:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'inn') ?>
						<?php echo $form->error($model, 'inn', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3">
						<label id="private_certificate_label"
							   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_CORPORATE): ?>display: none<?php endif; ?>">
							№ свидетельства:
						</label>
						<label id="corporate_certificate_label"
							   style="<?php if (isset($this->user->organizations->id) && $this->user->organizations->type_org_id == Organizations::TYPE_PRIVATE): ?>display: none<?php endif; ?>">
							Свидетельство плательщика НДС:
						</label>
					</div>
					<div class="grid9">
						<?php echo $form->textField($model, 'certificate') ?>
						<?php echo $form->error($model, 'certificate', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<div class="grid3"><label>Телефоны / Факс:</label></div>
					<div class="grid9">
						<?php echo $form->textField($model, 'phone') ?>
						<?php echo $form->error($model, 'phone', array('class' => 'error')); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="formRow">
					<?php echo CHtml::submitButton('Сохранить', array('class' => 'buttonM bBlack formSubmit')); ?>
					<div class="clear"></div>
				</div>
				<input type="hidden" id="privateName" value="ЧП <?php echo $privateName ?>" />
			</div>
			<div class="clear"></div>
			<?php //TODO Доделать функционал: js'ом меняются подписи полей, код едрпоу убирать если пользователь физическое лицо ?>
			<?php $this->endWidget(); ?>
		</div>

	</div>
	<!-- Content ends -->