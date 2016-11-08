<?php

/**
 * Lists all models.
 */
class IndexAction extends CAction
{
	public $view = 'index';
	
	public function run()
    {
		$controller = $this->controller;
		
		$dataProvider=new CActiveDataProvider($this->controller->modelName);
		$controller->render($this->view, array(
			'dataProvider'=>$dataProvider,
		));
    }
}
