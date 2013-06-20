<?php
/* @var $this UserController */
/* @var $model Users */

$this->pageTitle = Yii::app()->name . ' - Сообщения от пользователей';
$this->breadcrumbs = array(
	'Сообщения от пользователей',
);
?>

<!-- Sidebar begins -->
<div id="sidebar">
	<?php $this->renderPartial('/blocks/mainNav') ?>
    <!-- Secondary nav -->
    <div class="secNav">
		<?php
		$this->renderPartial('_secWrapper', array('selectProfile' => false))
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
                <li class="current"><a title="">Сообщения от пользователей</a></li>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
		<?php $this->renderPartial('/blocks/_notify') ?>
		<?php $this->renderPartial('/blocks/_middleNavR') ?>

        <div class="widget">
            <div class="whead">
                <h6>Messages layout #2</h6>
                <div class="on_off">
                    <span class="icon-reload-CW"></span>
                    <input type="checkbox" name="chbox" />
                </div>
                <div class="clear"></div>
            </div>

            <ul class="messagesTwo">
                <li class="by_user">
                    <a href="#" title=""><img src="images/live/face1.png" alt="" /></a>
                    <div class="messageArea">
                        <div class="infoRow">
                            <span class="name"><strong>Jonathan</strong> says:</span>
                            <span class="time">3 hours ago</span>
                            <div class="clear"></div>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.
                        Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                    </div>
                    <div class="clear"></div>
                </li>

                <li class="by_me">
                    <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                    <div class="messageArea">
                        <div class="infoRow">
                            <span class="name"><strong>Eugene</strong> says:</span>
                            <span class="time">3 hours ago</span>
                            <div class="clear"></div>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.
                        Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                    </div>
                    <div class="clear"></div>
                </li>

                <li class="by_me">
                    <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                    <div class="messageArea">
                        <div class="infoRow">
                            <span class="name"><strong>Eugene</strong> says:</span>
                            <span class="time">3 hours ago</span>
                            <div class="clear"></div>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.
                        Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                    </div>
                    <div class="clear"></div>
                </li>

                <li class="by_user">
                    <a href="#" title=""><img src="images/live/face1.png" alt="" /></a>
                    <div class="messageArea">
                        <div class="infoRow">
                            <span class="name"><strong>Jonathan</strong> says:</span>
                            <span class="time">3 hours ago</span>
                            <div class="clear"></div>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.
                        Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                    </div>
                    <div class="clear"></div>
                </li>

                <li class="by_me">
                    <a href="#" title=""><img src="images/live/face2.png" alt="" /></a>
                    <div class="messageArea">
                        <div class="infoRow">
                            <span class="name"><strong>Eugene</strong> says:</span>
                            <span class="time">3 hours ago</span>
                            <div class="clear"></div>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam vel est enim, vel eleifend felis. Ut volutpat, leo eget euismod scelerisque, eros purus lacinia velit, nec rhoncus mi dui eleifend orci.
                        Phasellus ut sem urna, id congue libero. Nulla eget arcu vel massa suscipit ultricies ac id velit
                    </div>
                    <div class="clear"></div>
                </li>
            </ul>
        </div>
		
    </div>
</div>

<!-- Content ends -->