<div id="locationDialog" class="dialog" title="Текущее расположение транспорта">
	<?php echo CHtml::beginForm(isset($vid) ? '/vehicle/search/location/vid/' . $vid : '', 'get', array('id' => 'locationForm')); ?>
		<div class="widget fluid" style="margin-top: 0px;">
			<div class="formRow">
				<div class="grid4">
					<?php
						echo CHtml::activeDropDownList($model, 'country_id', $countries,
							array('empty' => 'Выберите страну', 'class' => 'countryLocationVehicle', 'name' => 'vcoid', 'id' => 'vcoid'), array());
					?>
				</div>
				<div class="grid4">
					<?php echo CHtml::activeDropDownList($model, 'region_id', 
							$regions,
							array('empty' => 'Выберите регион', 'class' => 'regionLocationVehicle', 'name' => 'vrid', 'id' => 'vrid'), 
							array());
					?>
				</div>
				<div class="grid4">
					<?php echo CHtml::activeDropDownList($model, 'city_id', 
							$cities,
							array('empty' => 'Выберите населенный пункт', 'class' => 'cityLocationVehicle', 'name' => 'vcid', 'id' => 'vcid'), 
							array());
					?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	<?php echo CHtml::endForm(); ?>
</div>