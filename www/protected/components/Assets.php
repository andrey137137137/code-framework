<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Assets
{
	/**
	 * Array of paths of assets 
	 * @var array
	 */
	private static $_model;
	
	/**
	 * Array of paths of assets 
	 * @var array
	 */
	private static $_controller;
	
	/**
	 * Array of paths of assets 
	 * @var array
	 */
	private static $_view;
	
	/**
	 * Array of paths of assets 
	 * @var array
	 */
	private static $_dir;
	
	/**
	 * Array of paths of assets 
	 * @var array
	 */
	private static $_root = 'assets';

	/**
	 * Array of paths of assets 
	 * @var array
	 */
	private static $_paths = array();

	/**
	 * Array of asset Url
	 * @var array
	 */
	private static $_urls = array();

	/**
	 * Name of directory for css files
	 * @var strign
	 */
	private static $_types = array('js', 'css');

	/**
	 * Name of directory for css files
	 * @var strign
	 */
	private static $_type;
	
	/**
	 * Setup script files
	 * 
	 * @param string $view
	 * @param string $type
	 * @return void
	 */
	public static function run($controller, $view, $params = array())
	{
		$contrName = get_class($controller);
		$contrPos = strpos($contrName, 'Controller');
		
		self::$_model = substr($contrName, 0, $contrPos);
		self::$_controller = $controller;
		self::$_view = $view;
		
		$mainView = $view;
		
		foreach (self::$_types as $type)
		{
			self::$_type = $type;
			
			self::setRelationAssets($params[self::$_type][self::$_view]);
			
			self::$_view = $mainView;
			
			self::setMainAssets();
		}
	}
	
	/**
	 * Setup script files
	 * 
	 * @param string $view
	 * @param string $type
	 * @return void
	 */
	private static function setMainAssets($inRoots = true)
	{
		if ($inRoots)
			$dirs = array('root', 'controller', self::$_view);
		else
			$dirs = array(self::$_view);
		
		foreach ($dirs as $dir)
		{
			self::$_dir = $dir;
			self::setAssets();
		}
	}
	
	/**
	 * Setup script files
	 * 
	 * @param string $view
	 * @param string $type
	 * @return void
	 */
	private static function setRelationAssets($params)
	{
		if (!isset($params))
			return false;
		
		if (isset($params['relation']))
		{
			self::$_view = $params['relation'];
			self::setMainAssets();
		}
		
		if (isset($params['setVariables']))
		{
			$setVariables = $params['setVariables'];
			
			$params = 'all';
			
			if (isset($setVariables['params']))
				$params = $setVariables['params'];
			
			$exceptParams = array();
			
			if (isset($setVariables['exceptParams']))
				$exceptParams = $setVariables['exceptParams'];
			
			self::setVariables(new self::$_model, $exceptParams, $params);
		}
	}
	
	private static function setAssets()
	{
		$path = self::getPath();
		
		if (!$path)
			return false;
		
		$files = self::getFiles($path);
		
		if (!$files)
			return false;
		
		foreach ($files as $file)
		{
			if (!is_file($file))
				return false;
			
			$url = self::getUrl(basename($file));
			self::setAsset($url);
		}
	}
	
	private static function setAsset($url)
	{
		$clientAsset = Yii::app()->clientScript;
		
		switch (self::$_type)
		{
			case 'js': $clientAsset->registerScriptFile($url); break;
			case 'css': $clientAsset->registerCssFile($url); break;
		}
	}
	
	/**
	 * Returns the published script URL
	 * 
	 * @param string $view
	 * @param array $params
	 * @return string|false
	 */
	public static function getUrl($fileName)
	{
		$publishedUrl = self::getPublishedUrl($fileName);
		
		if (!$publishedUrl)
			return false;
		//var_dump($publishedUrl);echo '<br />';
		
		return $publishedUrl . '/' . self::$_type . '/' . $fileName;
	}

	/**
	 * Returns the published asset URL
	 * 
	 * @param string $view
	 * @return string|false
	 */
	public static function getPublishedUrl($fileName)
	{
	//	if (!isset(self::$_urls[self::$_dir][$fileName]))
	//	{
			$url = false;
			
			//var_dump($fileName);echo '<br />';
			$path = self::getPath($view);
			//var_dump($path);echo '<br />';
			
			if ($path)
				$url = self::publishAsset($path);
			//var_dump($url);echo '<br />';
			
			self::$_urls[self::$_dir][$fileName] = $url;
			//var_dump(self::$_urls[self::$_dir][$fileName]);echo '<br />';
	//	}

		return self::$_urls[self::$_dir][$fileName];
	}
	
	public static function publishAsset($path)
	{
		return Yii::app()->assetManager->publish($path, false, -1, YII_DEBUG);
	}
	
	/**
	 * Returns the real script Path
	 * 
	 * @param array $params
	 * @param string $view
	 * @return string|false
	 */
	public static function getFiles($path)
	{
		$files = array();
		
		$path .= DIRECTORY_SEPARATOR . self::$_type . DIRECTORY_SEPARATOR;
		
		if (!is_dir($path))
			return false;
		
		if (!($dd = opendir($path)))
			return false;
		while (($file = readdir($dd)) !== false)
		{
			if (is_dir($file))
				continue;
			
			$extPos = strrpos($file, '.');
			$ext = substr($file, $extPos + 1);
			
			if ($ext != self::$_type)
				continue;
			
			$files[] = $path . $file;
		}
		
		closedir($dd);
		
		if (!count($files))
			return false;
		
		return $files;
	}

	/**
	 * Returns the published image URL
	 * 
	 * @param string $view
	 * @param string $fileName
	 * @return string|false
	 */
	public static function getImageUrl($view, $fileName)
	{
		/*
		if (($publishedUrl = self::getPublishedAssetsUrl($view)))
		{
			return $publishedUrl . '/' . self::_imageDirName . '/' . $fileName;
		}

		return false;
		*/
		
		$params = array(
						'dirName' => self::_imageDirName,
						'fileName' => $fileName
						);
		
		return self::getAssetUrl($view, $params);
	}

	/**
	 * Returns the real image path
	 * 
	 * @param string $view
	 * @param string $fileName
	 * @return string|false
	 */
	public static function getImagePath($view, $fileName) 
	{
		/*
		if (($path = self::getAssetsPath($view)))
		{
			return $path . DIRECTORY_SEPARATOR . self::_imageDirName . DIRECTORY_SEPARATOR .  $fileName;
		}
		*/

		$params = array(
						'dirName' => self::_imageDirName,
						'fileName' => $fileName
						);
		
		return self::getAssetPath($view, $params);
	}

	/**
	 * Returns alias of assets
	 * 
	 * @param string $view
	 * @return string|false
	 */
	private static function getPath()
	{
		$root = false;
		
		if (self::$_dir == 'root')
			$root = 2;
		elseif (self::$_dir == 'controller')
			$root = 1;
		
		if (!isset(self::$_paths[self::$_dir]))
		{
			$assetPath = false;

			$viewPath = self::$_controller->getViewFile(self::$_view);
			
			if ($viewPath)
			{
				$DS = DIRECTORY_SEPARATOR;
				$aViewPath = explode($DS . 'views' . $DS, $viewPath);
				
				if (count($aViewPath) == 2)
				{
					if (!$root)
					{
						$extension = ($renderer=Yii::app()->getViewRenderer()) !== null ? $renderer->fileExtension : '.php';
					}
					
					if ($root > 1)
					{
						$assetPath = $aViewPath[0]
											. $DS
											. self::$_root;
					}
					else
					{
						$bufferAssetPath = $aViewPath[0]
											. $DS
											. self::$_root
											. $DS
											. $aViewPath[1];
						
						$assetPath = dirname($bufferAssetPath);
					}
					
					if (!$root)
					{
						$assetPath = $assetPath
									. $DS
									. basename($bufferAssetPath, $extension);
					}
				}
			}
			
			self::$_paths[self::$_dir] = $assetPath;
		}

		return self::$_paths[self::$_dir];
	}        

	private static function setVariables($model, $exceptParams = array(), $params = 'all')
	{
		$tableName = get_class($model);
		$columns = $tableName . ' = {';
		
		self::setVariablesFromArray($model->attributes, $columns, $tableName, $exceptParams);
		
		self::setVariablesFromArray(get_object_vars($model), $columns, $tableName, $exceptParams);
		
		$columns .= '};';
		
		Yii::app()->clientScript->registerScript($tableName, $columns, CClientScript::POS_HEAD);
	}
	
	private static function setVariablesFromArray($array, &$columns, $tableName, $exceptParams)
	{
		foreach ($array as $k => $v)
		{
			if (!array_key_exists($k, $exceptParams))
				$columns .= "\n" . $k . ": '#" . $tableName . '_' . $k . "',";
		}
	}
	
}
