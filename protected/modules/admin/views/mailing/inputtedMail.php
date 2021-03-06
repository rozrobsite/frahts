<div class="container-fluid">
	<div class="content">
		<?php $this->renderPartial('/blocks/_quickstats'); ?>
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Рассылка по заданным E-mail</h3>
						</div>
						<div class="box-content">
							<?php
								$this->widget('bootstrap.widgets.TbButtonGroup', array(
									'size'=>'small',
									'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									'buttons'=>array(
									   array('label'=>'Добавить пользователей', 'items'=>array(
											array('label'=>'Все', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_ALL_USERS . ', "Все пользователи");'),
											array('label'=>'Не добавившие личные данные', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_WITHOUT_PROFILES . ', "Пользователи не добавившие личные данные");'),
											array('label'=>'Добавившие личные данные', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_WITH_PROFILES . ', "Пользователи добавившие личные данные");'),
										 )),
									),
								));
							?>
							<?php
								$this->widget('bootstrap.widgets.TbButtonGroup', array(
									'size'=>'small',
									'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									'buttons'=>array(
									   array('label'=>'Добавить грузоотправителей', 'items'=>array(
											array('label'=>'Без груза', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_WITHOUT_GOOD . ', "Грузоотправители без груза");'),
											array('label'=>'С грузом', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_WITH_GOOD . ', "Грузоотправители c грузом");'),
											array('label'=>'Все', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_SHIPPER . ', "Все грузоотправители");'),
										 )),
									),
								));
							?>
							<?php
								$this->widget('bootstrap.widgets.TbButtonGroup', array(
									'size'=>'small',
									'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									'buttons'=>array(
									   array('label'=>'Добавить грузоперевозчиков', 'items'=>array(
											array('label'=>'Без транспорта', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_WITHOUT_VEHICLE . ', "Грузоперевозчики без транспорта");'),
											array('label'=>'С транспортом', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_WITH_VEHICLE . ', "Грузоперевозчики с транспортом");'),
											array('label'=>'Все', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_FREIGHTER . ', "Все грузоперевозчики");'),
										 )),
									),
								));
							?>
							<?php
								$this->widget('bootstrap.widgets.TbButtonGroup', array(
									'size'=>'small',
									'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									'buttons'=>array(
									   array('label'=>'Логистические операторы', 'items'=>array(
											array('label'=>'Без груза и транспорта', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_WITHOUT_VEHICLE_AND_GOOD . ', "Логистические операторы без груза и транспорта");'),
											array('label'=>'Только с грузом', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_DISPATCHER_WITH_GOOD . ', "Логистические операторы только с грузом");'),
											array('label'=>'Только с транспортом', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_DISPATCHER_WITH_VEHICLE . ', "Логистические операторы только с транспортом");'),
											array('label'=>'С грузом и транспортом', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_DISPATCHER_WITH_GOOD_AND_VEHICLE . ', "Логистические операторы с грузом и транспортом");'),
											array('label'=>'Все', 'url'=>'javascript:mailing.addUsers(' . Users::ADD_USERS_DISPATCHER . ', "Все логистические операторы");'),
										 )),
									),
								));
							?>
						</div>
						<div class="box-content">
							<label style="float: left;">Добавьте e-mail (по одному в каждой строке):</label><img id="loadingUsers" src="/images/loading.gif" style="display: none; margin-left: 10px;" />
							<label style="float: right;">Всего <span id="searchTextUsers"></span>: <span id="countUsers">0</span></label>

							<textarea id="emails" name="emails" style="width: 100%; min-height: 150px;"></textarea>

							<lable>Тема рассылки:</lable>
							<input type="text" id="subject" name="subject" style="width: 100%;"/>
							<label>Текст рассылки:</label>
							<textarea id="text" name="text" style="width: 100%; min-height: 150px;" class="ckeditor"></textarea>

							<div style="width: 100%; text-align: right; margin-top: 25px;">
								<?php $this->widget('bootstrap.widgets.TbButton', array(
									'type' => 'primary',
									'label'=>'Начать',
									'htmlOptions' => array('style' => 'margin-top: -10px', 'id' => 'sendingButton'))); ?>
							</div>
						</div>
						<div id="viewProgress" class="box-content" style="display: none;">
							<label id="sendedAction">Подготовка к отправке (Может занять несколько минут)</label>
							<?php
							$this->widget('bootstrap.widgets.TbProgress', array(
								'percent' => 100, // the progress
								'striped' => true,
								'animated' => true,
								'htmlOptions' => array(
									'id' => 'sendedProgress',
									'style' => 'width:50% !important; float:left',
								)
							));
							?>
							<label style="float: left; margin-left: 25px;">
								<span id="sendedPercent">0</span>% (<span id="sended">0</span> / <span id="sendedAll">0</span>)
							</label>
						</div>
					</div>
				</div>
			</div>
	</div>
</div>