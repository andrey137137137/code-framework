<?php

/**
 * This is the model class for tables.
 *
 * The followings are the available columns in table '{{status}}':
 * @property string $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property BattlePlayer[] $battlePlayers
 */
class CorrectPostFilter extends CFilter
{
	public $exceptParams = array();
	
	protected function preFilter($filterChain)
    {
		$controller = $filterChain->controller;
		
		$model = $controller->model;
		
		if (is_null($model))
			return false;
		
		$modelName = $controller->modelName;
		
		if(!$_POST[$modelName])
			return true;
		
		$post = $_POST[$modelName];
		
		if ($controller->action->id == 'create')
		{
			$controller->prevBattleEvent = $post;
		}
		
		$helpAttributes = get_object_vars($controller->model);
		
		foreach ($post as $key => $value)
		{
			$exceptParams = array_keys($this->exceptParams, $key);
			
			if (count($exceptParams) > 0)
				$model[$key] = $post[$key];
			
			if (isset($helpAttributes[$key]) || !isset($model->attributes[$key]))
				unset($post[$key]);
		}
		
	//	var_dump($_POST);
	//	echo '<br /><br />';
	//	var_dump($post);
	//	unset($_POST[$modelName]);
	//	$_POST[$modelName] = $post;
	//	echo '<br /><br />';
	//	var_dump($_POST);
		
		return true;
    }
}
