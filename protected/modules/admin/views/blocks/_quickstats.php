<div class="row-fluid no-margin">
	<div class="span12">
		<ul class="quickstats">
			<li>
				<div class="chart-detail" style="text-align: center;">
					<span class="amount green"><?php echo isset($this->users) ? $this->users : 0 ?></span>
					<span class="description">Всего пользователей</span>
				</div>
			</li>
			<li>
				<div class="chart-detail" style="text-align: center;">
					<span class="amount"><?php echo isset($this->freighter) ? $this->freighter : 0 ?></span>
					<span class="description">Грузоперевозчики</span>
				</div>
			</li>
			<li>
				<div class="chart-detail" style="text-align: center;">
					<span class="amount"><?php echo isset($this->shipper) ? $this->shipper : 0 ?></span>
					<span class="description">Грузоотправители</span>
				</div>
			</li>
			<li>
				<div class="chart-detail" style="text-align: center;">
					<span class="amount"><?php echo isset($this->dispatcher) ? $this->dispatcher : 0 ?></span>
					<span class="description">Диспетчеры</span>
				</div>
			</li>
			<li>
				<div class="chart-detail" style="text-align: center;">
					<span class="amount"><?php echo isset($this->vehicles) ? $this->vehicles : 0 ?></span>
					<span class="description">Транспорт</span>
				</div>
			</li>
			<li>
				<div class="chart-detail" style="text-align: center;">
					<span class="amount"><?php echo isset($this->goods) ? $this->goods : 0 ?></span>
					<span class="description">Грузы</span>
				</div>
			</li>
		</ul>

	</div>
</div>
