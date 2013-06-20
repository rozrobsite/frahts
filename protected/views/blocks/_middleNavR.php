<ul class="middleNavR">
	<?php /* ?>
	<li><a href="#" title="Add an article" class="tipN"><img src="images/icons/middlenav/create.png" alt="" /></a></li>
	<li><a href="#" title="Upload files" class="tipN"><img src="images/icons/middlenav/upload.png" alt="" /></a></li>
	<li><a href="#" title="Add something" class="tipN"><img src="images/icons/middlenav/add.png" alt="" /></a></li>
	<li><a href="#" title="Check statistics" class="tipN"><img src="images/icons/middlenav/stats.png" alt="" /></a></li>
	<?php */ ?>
	<li>
		<a href="/user/messages" title="Сообщения" class="tipN"><img src="/images/icons/middlenav/dialogs.png" alt="" /></a>
		<?php if ($this->messages_count): ?>
		<strong><?php echo $this->messages_count ?></strong>
		<?php endif; ?>
	</li>
</ul>