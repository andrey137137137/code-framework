<?php

/**
 * Displays a particular model.
 * @param integer $id the ID of the model to be displayed
 */
class ViewAction extends CAction
{
	public $view = 'view';
	
	public function run($id)
    {
		$controller = $this->controller;
		
		$controller->render($this->view, array(
			'model' => $controller->model,
		));
    }
}
