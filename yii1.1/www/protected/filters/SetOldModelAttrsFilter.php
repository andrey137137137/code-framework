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
class SetOldModelAttrsFilter extends CFilter
{
	public $exceptParams = array('id');
	
	protected function preFilter($filterChain)
    {
		$controller = $filterChain->controller;
		
		$model = $controller->model;
		
		if (is_null($model))
			return false;
		
		$modelName = $controller->modelName;
		
		if($_POST[$modelName])
			return true;
		
		foreach ($model->attributes as $key => $value)
		{
			$exceptParams = array_keys($this->exceptParams, $key);
			
			if (count($exceptParams) > 0)
				continue;
			
			$model['old_' . $key] = $value;
		}
		
		return true;
    }
}
