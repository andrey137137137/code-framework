<?php

/**
 * Creates a new model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 */
class CreateWithPrevItemAction extends CAction
{
	public $view = 'create';
	public $redirView = 'view';
	
	public function run()
    {
		$controller = $this->controller;
		
		$model = $controller->model;
		$modelName = $controller->modelName;
		$prevItem = 'prev' . $modelName;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST[$modelName]))
		{
			$model->attributes=$_POST[$modelName];
			
			if ($model->save())
				$controller->redirect(array($this->redirView, $prevItem => $_POST[$modelName]));
		}
		
		if (isset($_GET[$prevItem]))
			$model->attributes = $_GET[$prevItem];
		
		$controller->render($this->view, array(
			'model'=>$model,
		));
    }
}
