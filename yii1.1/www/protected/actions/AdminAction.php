<?php

/**
 * Manages all models.
 */
class AdminAction extends CAction
{
	public $view = 'admin';
	
	public function run()
    {
		$controller = $this->controller;
		
		$model = $controller->model;
		$modelName = $controller->modelName;
		
		$model->unsetAttributes();  // clear any default values
		
		if (isset($_GET[$modelName]))
			$model->attributes=$_GET[$modelName];
		
		$controller->render($this->view, array(
			'model'=>$model,
		));
    }
}
