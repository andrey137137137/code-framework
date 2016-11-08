<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public $model;
	public $modelName;
	
	protected $_viewAssetSettings=array();
	
	/**
	 * This method is invoked at the beginning of {@link render()}.
	 * 
	 * @param string $view the view to be rendered
	 * @return boolean whether the view should be rendered.
	 */
	protected function beforeRender($view)
	{
		//$this->_rootAssetsPath = DIRECTORY_SEPARATOR . $this->_rootAssetsPath . DIRECTORY_SEPARATOR;
		
		Yii::app()->getClientScript()->registerCoreScript('jquery');
		/*
		$publish = Yii::app()->assetManager->publish(
						Yii::app()->basePath
						. $this->_rootAssetsPath
						. $this->_scriptDefaults['dirName']
						. DIRECTORY_SEPARATOR
						. 'JavaScriptRuKantor.js'
						, false, 0, YII_DEBUG);
		
		$javaScriptRuKantor = Yii::app()->basePath
							. $this->_rootAssetsPath
							. $this->_scriptDefaults['dirName']
							. DIRECTORY_SEPARATOR
							. 'JavaScriptRuKantor.js';
		
		$publish = $this->publishAsset($javaScriptRuKantor);
		
		Yii::app()->clientScript->registerScriptFile($publish, CClientScript::POS_HEAD);
		*/
		/*
		$this->_setupScript($view);
		$this->_setupCss($view);
		*/
		
		Assets::run($this, $view, $this->_viewAssetSettings);
		
		/*
		$this->_setupAssets($view, 'script');
		$this->_postSetupAssets($view, 'script');

		$this->_setupAssets($view, 'css');
		$this->_postSetupAssets($view, 'css');

		$viewCamelCase = preg_replace_callback(
			'/_([a-z0-9])/',
			function ($char)
			{
				return strtoupper($char[1]);
			},
			ucfirst($view)
		);
		
		$methodScript = '_setupScript' . $viewCamelCase;
		
		if (method_exists($this, $methodScript))
		{
			$this->$methodScript($view);
		}

		$methodCss = '_setupCss' . $viewCamelCase;
		
		if (method_exists($this, $methodCss))
		{
			$this->$methodCss($view);
		}
		*/
		return true;
	}
}
