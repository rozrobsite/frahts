<ul class="middleNavR">
	<li>
		<a href="/offers" title="Предложения" class="tipN"><img src="/images/icons/middlenav/add.png" alt="" /></a>
		<?php/* if ($this->newOffersCount): ?>
			<strong><?php echo $this->newOffersCount ?></strong>
		<?php endif; */?>
	</li>
	<li>
		<a href="/user/notes" title="Заметки" class="tipN"><img src="/images/icons/middlenav/create.png" alt="" /></a>
		<?php if ($this->notesCount): ?>
			<strong><?php echo $this->notesCount ?></strong>
		<?php endif; ?>
	</li>
	<?php /* ?>
	<li><a href="#" title="Upload files" class="tipN"><img src="images/icons/middlenav/upload.png" alt="" /></a></li>
	<li><a href="#" title="Add something" class="tipN"><img src="images/icons/middlenav/add.png" alt="" /></a></li>
	<li><a href="#" title="Check statistics" class="tipN"><img src="images/icons/middlenav/stats.png" alt="" /></a></li>
	<?php */ ?>
	<li>
		<a href="/user/messages#users_message" title="Сообщения" class="tipN"><img src="/images/icons/middlenav/dialogs.png" alt="" /></a>
		<?php if ($this->messagesCount): ?>
			<strong><?php echo $this->messagesCount; ?></strong>
		<?php endif; ?>
	</li>
</ul>