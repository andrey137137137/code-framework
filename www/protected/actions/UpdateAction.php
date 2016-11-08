<?php

/**
 * Updates a particular model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param integer $id the ID of the model to be updated
 */
class UpdateAction extends CAction
{
	public $view = 'update';
	public $redirView = 'view';
	
	public function run($id)
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
				$controller->redirect(array($this->redirView, 'id'=>$model->id));
		}
		
		$controller->render($this->view, array(
			'model'=>$model,
		));
    }
}
