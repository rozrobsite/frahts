<div class="secWrapper">	<?php $this->renderPartial('/blocks/secTop') ?>	<!-- Tabs container -->	<div id="tab-container" class="tab-container">		<ul class="iconsLine ic1 etabs">			<li class="user_profile_tab"><a href="#settings" title="Настройки" class="tipS"><span class="exp subClosed">Настройки</span></a></li>		</ul>		<div class="divider"><span></span></div>		<?php $this->renderPartial('/blocks/generalSettings', array(				'profiles' => isset($profiles) && $profiles ? true : false,				'organization' => isset($organization) && $organization ? true : false,			)) ?>		<div class="divider"><span></span></div>	</div></div><div class="clear"></div>