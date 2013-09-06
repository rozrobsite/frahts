<div class="container-fluid">
	<div class="content">
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-head">
						<h3>Рассылка</h3>
					</div>
					<div class="box-content">
						<label style="float: left;margin-right: 20px;">Напоминание грузоперевозчикам об обновлении срока загрузки и местоположения</label>
						<?php
						$this->widget('bootstrap.widgets.TbButton', array(
							'label' => 'Отправить',
							'type' => 'primary',
							'size' => 'small',
							'id' => 'updateVehicle'

						));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>