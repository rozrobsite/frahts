<li>
	<span class="fileQueue"></span>
	<a href="/goods/search<?php echo $filter->getVehiclesUri((int) $data->id); ?>" class="tipS" title="Нажмите на этот груз чтобы найти подходящие для него транспортные средства">
		<?php echo '№' . $data->id . ' - ' . $data->name ?>
	</a>
	<a href="/goods/update/<?php echo $data->id ?>" class="edit tipS" style="width: 10px;height: 9px;" original-title="Редактировать" title="Редактировать"></a>
</li>
