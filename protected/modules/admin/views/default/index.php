<?php
/* @var $this DefaultController */

//$this->adminBreadcrumbs=array(
//	'/admin/' => 'Главная',
//);
?>
<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="box">
					<div class="box-head">
						<h3>Графики состояния сайта</h3>
						<div class="actions">
							<ul>
								<li class="dropdown">
									<a href="#" class='btn btn-mini dropdown-toggle' data-toggle="dropdown">
										<img src="/images/admin/icons/fugue/gear.png" alt="">
									</a>
									<ul class="dropdown-menu pull-right custom">
										<li>
											<a href="#" class='fugue'><img src="img/icons/fugue/printer.png" alt=""> Print chart</a>
										</li>	
										<li class="divider"></li>
										<li>
											<a href="#" class='fugue'><img src="img/icons/fugue/gear.png" alt=""> Chart settings</a>
										</li>
										<li>
											<a href="#" class='fugue'><img src="img/icons/fugue/bin-metal.png" alt=""> Delete chart</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#" class='btn btn-mini tip' title="Save this chart">
										<img src="/images/admin/icons/fugue/disk-black.png" alt="">
									</a>
								</li>
							</ul>	
						</div>
					</div>
					<div class="box-content">
						<div class="flot flot-line"></div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>