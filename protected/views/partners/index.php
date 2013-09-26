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
			<div class="widget">
				<div class="whead"><h6>With custom toolbar</h6><div class="clear"></div></div>
				<ul class="tToolbar">
					<li>
						<a href="#" title="">
						<div class="selector">
							<select id="partnerSearchCountry" name="partnerSearchCountry" >
								<option value="">Выберите страну</option>
								<?php foreach ($countries as $country): ?>
									<option value="<?php echo $country->id; ?>"><?php echo $country->name_ru; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						</a>
					</li>
					<li><a href="#" title=""><span class="icos-outbox"></span>Export table content</a></li>
					<li><a href="#" title=""><span class="icos-download"></span>Download statement</a></li>
				</ul>
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