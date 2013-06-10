<?php

class ElfinderController extends AdminController
{
	public function actions()
	{
		return array(
			'connector' => array(
				'class' => 'ext.elFinder.ElFinderConnectorAction',
				'settings' => array(
					'root' => Yii::getPathOfAlias('webroot') . '/uploads/',
					'URL' => Yii::app()->baseUrl . '/uploads/',
					'rootAlias' => 'Main',
					'mimeDetect' => 'none',
					'id' => 'none'
				)
			),
		);
	}

}