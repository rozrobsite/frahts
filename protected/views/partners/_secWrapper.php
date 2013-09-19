<div class="secWrapper">

	<?php $this->renderPartial('/blocks/secTop') ?>

	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#searchUsers" class="exp subClosed">Поиск партнеров</a></li>
		</ul>

		<div class="divider"><span></span></div>

		<?php
		$form = $this->beginWidget('CActiveForm',
				array(
			'id' => 'searchPartnersForm',
			'enableAjaxValidation' => false,
			'clientOptions' => array(
				'validateOnSubmit' => false,
			),
			'htmlOptions' => array('class' => 'main'),
				));
		?>
		<div id="searchUsers" class="sideWidget">
			<div class="formRow">
				<select id="partnerSearchCountry" name="partnerSearchCountry" >
					<option value="">Выберите страну</option>
					<?php foreach ($countries as $country): ?>
						<option value="<?php echo $country->id; ?>"><?php echo $country->name_ru; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="formRow">
				<select id="partnerSearchRegion" name="partnerSearchRegion" >
					<option value="">Выберите регион</option>
				</select>
			</div>
			<div class="formRow">
				<select id="partnerSearchCity" name="partnerSearchCity" >
					<option value="">Выберите населенный пункт</option>
				</select>
			</div>
			<div class="formRow">
				<input type="text" name="partnerSearchName" placeholder="Введите имя" />
			</div>

			<div class="divider"><span></span></div>


		</div>
		<?php $this->endWidget(); ?>

		<div class="clear"></div>
	</div>

</div>
<div class="clear"></div>