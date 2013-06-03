<div class="secWrapper">
	<?php $this->renderPartial('/blocks/secTop') ?>
	<!-- Tabs container -->
	<div id="tab-container" class="tab-container">
		<ul class="iconsLine ic1 etabs">
			<li class="user_profile_tab"><a href="#type_documents" title="Настройки пользователя" class="exp subClosed">Вид документации</a></li>
		</ul>
		<div class="divider"><span></span></div>
		<div id="type_documents">
			<ul class="subNav">
				<?php foreach($docsType as $docType): ?>
					<li><a href="/docs/type/<?php echo $docType->id ?>" title="" <?php if ($docType->id == $currentDocType_id): ?>class="this"<?php endif; ?>>
							<span class="icos-truck"></span><?php echo $docType->name_ru ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>
<div class="clear"></div>