<?php

/**
 * Creates a new model.
 * If creation is successful, the browser will be redirected to the 'view' page.
 */
class CreateAction extends CAction
{
	public $view = 'create';
	public $redirView = 'view';
	
	public function run()
    {
		$controller = $this->controller;
		
		$model = $controller->model;
		$modelName = $controller->modelName;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST[$modelName]))
		{
			$model->attributes=$_POST[$modelName];
			
			if ($model->save())
				$controller->redirect(array($this->view, 'id' => $model->id));
		}
		
		$controller->render($this->view, array(
			'model'=>$model,
		));
    }
}
