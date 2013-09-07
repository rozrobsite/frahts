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
						<?php if (time() - $updateVehicle->created_at > 86400): ?>
							<?php
							$this->widget('bootstrap.widgets.TbButton', array(
								'label' => 'Отправить',
								'type' => 'primary',
								'size' => 'small',
								'id' => 'updateVehicle',
							));
							?>
						<?php endif; ?>
						<label style="float:right;margin-right: 20px;">
							(Последний раз:
							<span id="lastStartUpdateVehicle" style="font-style: italic">
								<?php if ($updateVehicle->created_at == 0): ?>
									Никогда
								<?php else: ?>
									<?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy HH:mm', $updateVehicle->created_at); ?>
								<?php endif; ?>
							</span>)
						</label>
					</div>
					<div id="updateVehicleViewProgress" class="box-content" style="display: none">
						<label id="updateVehicleAction">Подготовка к отправке (Может занять несколько минут)</label>
						<?php
						$this->widget('bootstrap.widgets.TbProgress', array(
							'percent' => 100, // the progress
							'striped' => true,
							'animated' => true,
							'htmlOptions' => array(
								'id' => 'updateVehicleProgress',
								'style' => 'width:50% !important; float:left',
							)
						));
						?>
						<label style="float: left; margin-left: 25px;">
							<span id="updateVehicleSendedPercent">0</span>% (<span id="updateVehicleSended">0</span> / <span id="updateVehicleAll">0</span>)
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>