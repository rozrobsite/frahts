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
			'currentDocType_id' => $currentDocType_id,
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
                <li class="current"><a>Полезная документация</a></li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_middleNavR') ?>
		<?php if (!$docs): ?>
			<div class="fluid" style="text-align: center;margin-top: 50px;">
				<label style="font-weight: bold; font-size: 16px;">
					Не найдено ни одного документа.
				</label>
			</div>
		<?php else: ?>
			<div class="fluid">
				<div class="widget" style="margin-top: 10px;">
					<div class="whead">
						<h6>Документы</h6>
						<div class="clear"></div>
					</div>
					<div class="body">
                        <ul class="liInfo">
							<?php foreach ($docs as $doc): ?>
								<li>
									<a href="/docs/view/<?php echo $doc->slug; ?>"><?php echo $doc->title ?></a>
								</li>
							<?php endforeach; ?>
                        </ul>
                    </div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<!-- Content ends -->
<?php $this->renderPartial('/blocks/_notify') ?>