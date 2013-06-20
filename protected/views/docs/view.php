<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Полезная документация';
$this->breadcrumbs = array(
	'Полезная документация',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array(
			'docsType' => $docsType,
			'currentDocType_id' => $model->docs_type_id,
			))
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
                <li><a href="/">Главная</a></li>
                <li><a href="/docs">Полезная документация</a></li>
                <li class="current"><a><?php echo $model->title ?></a></li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_middleNavR') ?>
		<div class="fluid">
			<div class="widget" style="margin-top: 10px;">
					<div class="invoice">
						<div class="inHead">
							<span class="inLogo"><?php echo $model->title; ?></span>
							<div class="inInfo">
								<span class="invoiceNum"><?php echo $model->docsType->name_ru; ?></span>
								<i><?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $model->created_at); ?></i>
							</div>
							<div class="clear"></div>
						</div>

						<div class="inContainer">
							<?php echo $model->text; ?>
							<div class="clear"></div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<!-- Content ends -->
<?php $this->renderPartial('/blocks/_notify') ?>