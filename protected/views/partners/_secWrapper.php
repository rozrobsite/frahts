<div class="secWrapper">

	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#usersBlock" class="exp subClosed">Поиск пользователей</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<div id="usersBlock">
			<?php /*
				$this->renderPartial('/blocks/_subnav', array(
					'selectProfile' => false,
					'selectOrganization' => false,
					'selectReviews' => false,
					'selectSearchUsers' => true,
				));*/
			?>
			<!--<div class="divider"><span></span></div>-->
		</div>

		<?php
		$form = $this->beginWidget('CActiveForm',
				array(
			'id' => 'searchPartnersForm',
			'enableAjaxValidation' => false,
			'method' => 'get',
			'action' => '/partners/search',
			'clientOptions' => array(
				'validateOnSubmit' => false,
			),
			'htmlOptions' => array('class' => 'main'),
				));
		?>
		<div id="searchUsers" class="sideWidget">
			<div class="formRow">
				<?php
					echo CHtml::activeDropDownList($model, 'partnerSearchCountry', $countries, array('empty' => 'Выберите страну', 'name' => 'partnerSearchCountry'));
				?>
			</div>
			<div class="formRow">
				<?php
					echo CHtml::activeDropDownList($model, 'partnerSearchRegion', $regions, array('empty' => 'Выберите регион', 'name' => 'partnerSearchRegion', 'class' => 'searchPartnerRegion'));
				?>
			</div>
			<div class="formRow">
				<?php
					echo CHtml::activeDropDownList($model, 'partnerSearchCity', $cities, array('empty' => 'Выберите населенный пункт', 'name' => 'partnerSearchCity', 'class' => 'searchPartnerCity'));
				?>
			</div>
			<div class="formRow">
				<?php echo $form->checkBox($model, 'partnerSearchShipper', array('class' => 'check', 'name' => 'partnerSearchShipper')); ?>
				<label for="partnerSearchShipper"  class="nopadding">Грузоперевозчики</label>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<?php echo $form->checkBox($model, 'partnerSearchFreighter', array('class' => 'check', 'name' => 'partnerSearchFreighter')); ?>
				<label for="partnerSearchFreighter"  class="nopadding">Грузоотправители</label>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<?php echo $form->checkBox($model, 'partnerSearchDispatcher', array('class' => 'check', 'name' => 'partnerSearchDispatcher')); ?>
				<label for="partnerSearchDispatcher"  class="nopadding">Логистические операторы</label>
				<div class="clear"></div>
			</div>
			<div class="formRow">
				<?php echo $form->textField($model, 'partnerSearchWords', array('placeholder' => 'Введите имя или название', 'name' => 'partnerSearchWords')) ?>
			</div>
			<div class="formRow noBorderB">
				<?php
					echo CHtml::submitButton('Найти', array('class' => 'buttonS bLightBlue'));
				?>
			</div>

			<div class="divider"><span></span></div>

		</div>
		<?php $this->endWidget(); ?>

		<div class="clear"></div>

	</div>

</div>
<div class="clear"></div>