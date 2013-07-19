<div id="advancedFilterDialog" class="dialog" title="Дополнительные настройки поиска">	<?php	echo CHtml::beginForm(isset($vid) ? '/vehicle/search/vid/' . $vid : '/vehicle/search',			'get', array('id' => 'advancedFilterForm'));	?>	<div class="widget fluid filter" style="margin-top: 0px;">		<div class="formRow">			<div class="grid12 check">				<div class="checker" id="uniform-check1">					<span class="">						<input type="checkbox" id="check_dispatcher" name="check_dispatcher" <?php if ($filter->check_dispatcher): ?>checked="checked"<?php endif; ?>>					</span>				</div>				<label for="check_dispatcher" class="mr20">Не показывать предложения от диспетчеров</label>			</div>			<div class="clear"></div>		</div>		<div class="formRow">			<div class="grid3"><label>Дата доставки:</label></div>			<div class="grid9">				<ul class="datesRange">					<li>						<?php						echo CHtml::textField('date_from',								$filter->date_from, array('id' => 'fromDate', 'placeholder' => 'С'))						?>					</li>					<li class="sep" style="font-weight: bold">-</li>					<li>						<?php						echo CHtml::textField('date_to',								$filter->date_to, array('id' => 'toDate', 'placeholder' => 'По'))						?>					</li>				</ul>			</div>			<div class="clear"></div>		</div>		<div class="formRow">			<div class="grid12">				<label>Откуда:</label>			</div>			<div class="clear"></div>		</div>		<div class="formRow">			<div class="grid4">				<?php					echo CHtml::activeDropDownList($filter, 'country_id', $countries,						array('empty' => 'Выберите страну', 'class' => 'countryLocationVehicle', 'name' => 'vcoid', 'id' => 'vcoid'), array());				?>			</div>			<div class="grid4">				<?php echo CHtml::activeDropDownList($filter, 'region_id',  $regions,						array('empty' => 'Выберите регион', 'class' => 'regionLocationVehicle', 'name' => 'vrid', 'id' => 'vrid'),						array());				?>			</div>			<div class="grid4">				<?php echo CHtml::activeDropDownList($filter, 'city_id', $cities,						array('empty' => 'Выберите населенный пункт', 'class' => 'cityLocationVehicle', 'name' => 'vcid', 'id' => 'vcid'),						array());				?>			</div>			<div class="clear"></div>		</div>		<div class="formRow">			<div class="grid12">				<label>Куда:</label>			</div>			<div class="clear"></div>		</div>		<div class="formRow">			<div class="grid4" style="margin-top: -10px;">				<?php				echo CHtml::activeDropDownList($filter, 'country_search_id', $filterCountries,						array('empty' => 'Выберите страну', 'class' => 'countryFilterVehicle', 'name' => 'fvcoid', 'id' => 'fvcoid'),						array());				?>			</div>			<div class="grid4" style="margin-top: -10px;">				<?php				echo CHtml::activeDropDownList($filter, 'region_search_id', $filterRegions,						array('empty' => 'Выберите регион', 'class' => 'regionFilterVehicle', 'name' => 'fvrid', 'id' => 'fvrid'),						array());				?>			</div>			<div class="grid4" style="margin-top: -10px;">				<?php				echo CHtml::activeDropDownList($filter, 'city_search_id', $filterCities,						array('empty' => 'Выберите населенный пункт', 'class' => 'cityFilterVehicle', 'name' => 'fvcid', 'id' => 'fvcid'),						array());				?>			</div>			<div class="clear"></div>		</div>		<div class="formRow">			<div class="grid3">				<label>Искать в радиусе:</label>			</div>			<div class="grid2">				<?php				echo CHtml::activeDropDownList($filter, 'radius', Yii::app()->params['radius'],						array('name' => 'radius', 'id' => 'radius'),						array());				?>			</div>			<div class="grid1">				<label>км</label>			</div>			<div class="clear"></div>		</div>	</div><?php echo CHtml::endForm(); ?></div>