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
class LoadModelFilter extends CFilter
{
	protected function preFilter($filterChain)
    {
		$controller = $filterChain->controller;
		
		$modelName = Crud::getModelName($controller);
		
		$controller->modelName = $modelName;
		
		switch ($controller->action->id)
		{
			case 'create':
							$controller->model = new $modelName;
							break;
			
			case 'admin':
							$controller->model = new $modelName('search');
							break;
			
			case 'view':
			case 'update':
			case 'delete':
							$params = $controller->getActionParams();
							$id = isset($params['id']) ? $params['id'] : 0;
							
							$controller->model = Crud::loadModel($modelName, $id);
							break;
			
			case 'playersDefaults':
							$controller->model = $modelName::model()->findAll();
							break;
		}
		
		return true;
    }
}
