<?php

/**
 * Updates a particular model.
 * If update is successful, the browser will be redirected to the 'view' page.
 * @param integer $id the ID of the model to be updated
 */
class UpdateTransactionAction extends CAction
{
	public $view = 'update';
	public $redirView = 'view';
	
	public function run($id = false)
    {
		$controller = $this->controller;
		
		$model = $controller->model;
		$modelName = $controller->modelName;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if (isset($_POST[$modelName]))
		{
			$model->attributes=$_POST[$modelName];
			
			$transaction = $model->getDbConnection()->beginTransaction();
			
			try
			{
				$model->save();
				$transaction->commit();
				
				$controller->redirect(array($this->redirView, 'id'=>$model->id));
			}
			catch (Exception $e)
			{
				$transaction->rollback();
			}
		}
		
		$controller->render($this->view, array(
			'model'=>$model,
		));
    }
}
