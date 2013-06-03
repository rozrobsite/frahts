<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Данные о грузе "' . $model->name . '"';
$this->breadcrumbs = array(
	'Данные о грузе',
);
?>
<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapperDetail', array());
		?>
	</div>
</div>
<!-- Sidebar ends -->
<div id="content">
	<?php $this->renderPartial('/blocks/contentTop') ?>

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><a href="<?php echo Yii::app()->session['redirectUrl']; ?>">Поиск грузов</a></li>
                <li class="current">
					<a title="">
						<?php echo 'Данные о грузе "' . $model->name . '"'; ?>
					</a>
				</li>
            </ul>
        </div>

    </div>

    <!-- Main content -->
    <div class="wrapper">
	<?php $this->renderPartial('/blocks/_notify') ?>
		<div class="widget">
            <div class="invoice">
                <div class="inHead">
                    <!--<span class="inLogo"><a href="index.html" title="invoice"><img src="images/newLogo.png" alt="logo" /></a></span>-->
                    <div class="inInfo">
                        <span class="invoiceNum"><?php echo $model->name ?></span>
                        <i>Добавлено: <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy H:m', $model->updated_at); ?></i>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inContainer">
                    <div class="inFrom" style="width:30%">
                        <h5>Данные о грузе</h5>
                        <span><strong>Дата доставки:</strong> с <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_from); ?>
							по <?php echo Yii::app()->dateFormatter->format('dd.MM.yyyy', $model->date_to); ?></span>
                        <span><strong>Откуда:</strong> <?php echo $model->cityFrom->name_ru ?>, <?php echo $model->regionFrom->name_ru ?>, <?php echo $model->countryFrom->name_ru ?></span>
                        <span><strong>Куда:</strong> <?php echo $model->cityTo->name_ru ?>, <?php echo $model->regionTo->name_ru ?>, <?php echo $model->countryTo->name_ru ?></span>
                        <span><strong>Подходящие типы транспорта:</strong> <?php echo $vehicleTypes; ?></span>
                        <span><strong>Подходящие типы кузовов:</strong> <?php echo $bodyTypes; ?></span>
                        <span>Zip/Postal Code</span>
                        <span class="number">Mobile Phone: <strong class="red">+4530422244</strong></span>
                        <span class="black">Send To: <a href="#">me@company.com</a></span>
                        <span>Payment due by <strong>10/06/2012</strong></span>
                    </div>

                    <div class="floatR">
                    <div class="inTo">
                        <h5>Client Company Name</h5>
                        <span>Client Address Line 1</span>
                        <span>Address Line 2</span>
                        <span>Town</span>
                        <span>Region/State</span>
                        <span>Zip/Postal Code</span>
                        <span class="number">Mobile Phone: <strong class="red">+4530422244</strong></span>
                        <span class="black">Email: <a href="#">client@company.com</a></span>
                    </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tLight">
                    <thead>
                        <tr>
                            <td width="30%">Product</td>
                            <td width="42%">Descrition</td>
                            <td width="19%">Discount</td>
                            <td width="9%">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Concept</td>
                            <td>Creating project concept and logic</td>
                            <td>0</td>
                            <td><strong>$1100</strong></td>
                        </tr>
                        <tr>
                            <td>General design</td>
                            <td>Design prototype</td>
                            <td>0</td>
                            <td><strong>$2000</strong></td>
                        </tr>
                        <tr>
                            <td>Front end development</td>
                            <td>Coding and connecting front end</td>
                            <td>0</td>
                            <td><strong>$1600</strong></td>
                        </tr>
                        <tr>
                            <td>Database</td>
                            <td>Creating and connecting database</td>
                            <td>0</td>
                            <td><strong>$890</strong></td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <div class="inFrom">
                        <h5>Payment method: <i class="red">Wire transfer</i></h5>
                        <span>Bank account #</span>
                        <span>SWIFT code</span>
                        <span>IBAN</span>
                        <span>Billing address</span>
                        <span>Name</span>
                    </div>

                    <div class="total">
                        <span>Amount Due</span>
                        <strong class="red">$00.00</strong>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inFooter">
                    <div class="footnote">Thank you very much for choosing us. It was pleasure to work with you.</div>
                    <ul class="cards">
                        <li class="discover"><a href="#"></a></li>
                         <li class="visa"><a href="#"></a></li>
                         <li class="mc"><a href="#"></a></li>
                         <li class="pp"><a href="#"></a></li>
                         <li class="amex"><a href="#"></a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
	</div>
</div>
<!-- Content ends -->
