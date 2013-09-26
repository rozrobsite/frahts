<?php
Yii::app()->clientScript->registerScriptFile('/js/files/partners.js', CClientScript::POS_BEGIN);

$this->pageTitle = Yii::app()->name . ' - Поиск пользователей';
$this->breadcrumbs = array(
	'Поиск пользователей',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'countries' => $countries,
		));
		?>
	</div>
</div>

<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?php echo isset($this->headerUrl) ? $this->headerUrl : '/user'; ?>">Главная</a></li>
                <li class="current"><a title="">Партнеры</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

		<div class="fluid">
			<?php
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'searchPartnersForm',
				'enableAjaxValidation' => false,
				'clientOptions' => array(
					'validateOnSubmit' => false,
				),
				'htmlOptions' => array('class' => 'main'),
				));
			?>
			<fieldset>
				<div class="widget" style="min-width: 566px;max-width: 566px;">
					<div class="whead"><h6>Настройки поиска</h6><div class="clear"></div></div>
					<div class="formRow">
						<div class="" style="float: left; margin-right: 20px;">
							<select id="partnerSearchCountry" name="partnerSearchCountry">
								<option value="">Выберите страну</option>
								<?php foreach ($countries as $country): ?>
									<option value="<?php echo $country->id; ?>"><?php echo $country->name_ru; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="" style="float: left; margin-right: 20px;">
							<select id="partnerSearchRegion" name="partnerSearchRegion" >
								<option value="">Выберите регион</option>
							</select>
						</div>
						<div class="" style="margin-right: 20px;">
							<select id="partnerSearchCity" name="partnerSearchCity" >
								<option value="">Выберите населенный пункт</option>
							</select>
						</div>
						<div class="" style="float: left; margin-right: 20px; margin-top: 20px;">
							<input type="checkbox" id="partnerSearchShipper" name="partnerSearchShipper" checked="checked" class="check" />
							<label for="partnerSearchShipper"  class="nopadding">Грузоперевозчики</label>
						</div>
						<div class="" style="float: left; margin-right: 20px; margin-top: 20px;">
							<input type="checkbox" id="partnerSearchFreighter" name="partnerSearchFreighter" checked="checked" class="check" />
							<label for="partnerSearchFreighter"  class="nopadding">Грузоотправители</label>
						</div>
						<div class="" style="margin-right: 20px; margin-top: 20px;">
							<input type="checkbox" id="partnerSearchDispatcher" name="partnerSearchDispatcher" checked="checked" class="check" />
							<label for="partnerSearchDispatcher"  class="nopadding">Логистические операторы</label>
						</div>
						<div class="" style="margin-right: 20px; margin-top: 20px;">
							<input type="text" name="partnerSearchWords" placeholder="Введите имя или название" />
						</div>
						<div class="" style="margin-top: 20px; text-align: right">
							<input type="submit" class="buttonS bLightBlue" value="Найти">
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</fieldset>
			<?php $this->endWidget(); ?>
			<div class="widget">
				<div class="whead"><h6>Список пользователей</h6><div class="clear"></div></div>
				<table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
					<thead>
						<tr>
							<td>Column name</td>
							<td>Column name</td>
							<td>Column name</td>
							<td>Column name</td>
							<td>Column name</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Row 1</td>
							<td>Row 2</td>
							<td>Row 3</td>
							<td>Row 4</td>
							<td>Row 5</td>
						</tr>
						<tr>
							<td>Row 1</td>
							<td>Row 2</td>
							<td>Row 3</td>
							<td>Row 4</td>
							<td>Row 5</td>
						</tr>
						<tr>
							<td>Row 1</td>
							<td>Row 2</td>
							<td>Row 3</td>
							<td>Row 4</td>
							<td>Row 5</td>
						</tr>
						<tr>
							<td>Row 1</td>
							<td>Row 2</td>
							<td>Row 3</td>
							<td>Row 4</td>
							<td>Row 5</td>
						</tr>
						<tr>
							<td>Row 1</td>
							<td>Row 2</td>
							<td>Row 3</td>
							<td>Row 4</td>
							<td>Row 5</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>

    </div>
</div>
<!-- Content ends -->