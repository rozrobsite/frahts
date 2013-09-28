<style>
	div.body .avatar, div.body.info {
		height: 80px;
		float: left;
	}
	div.body .avatar {
		margin-right: 15px;
	}
	div.body .info div {
		width: 100%;
	}
	div.body .info div.org, div.body .info div.user-type {
		margin-bottom: 5px;
	}
	div.body .info div.user-type {
		font-style: italic;
	}
	div.body .info div.org {
		color: #A64949;
	}
	div.body .info div.location {
		color: #808080;
	}
</style>
<div class="widget" style="margin-right: 30px; width: 333px !important; min-width: 333px !important;">
	<div class="whead">
		<h6><?php echo $data->profiles->userType->name_ru; ?></h6>
		<div class="titleOpt">
			<a href="javascript:void(0)" data-toggle="dropdown"><span class="iconb" data-icon="&#xe04d;"></span><span class="clear"></span></a>
			<ul class="dropdown-menu pull-right">
			  <li><a href="/user/messages/user/<?php echo $data->id; ?>#users_message" class=""><span class="icos-speech"></span>Написать сообщение</a></li>
			</ul>
		</div>
		<div class="clear"></div></div>
	<div class="body">
		<div class="avatar">
			<img src="<?php echo ($data->profiles->avatar ? '/' . Yii::app()->params['files']['avatars'] . $data->id . '_s.jpg' : Yii::app()->params['imagesPath'] . 'userLogin3.png') ?>" />
		</div>
		<div class="info">
			<div class="user-name"><a href="/user/view/<?php echo $data->id; ?>"><h6><?php echo $data->profiles->shortName(); ?></h6></a></div>
			<?php if (is_object($data->organizations)): ?>
				<div class="org"><?php echo $data->organizations->name_org; ?></div>
			<?php endif; ?>
			<div class="location"><?php echo $data->profiles->locationString(); ?></div>
		</div>
	</div>
</div>
