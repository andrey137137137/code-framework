<?php

class SiteController extends Controller
{
	public $layout='column2';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionIndex()
	{
	    if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException('Url should be requested via ajax only');
		
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Product']))
				$model->attributes=$_GET['Product'];
		
		$this->renderPartial('_grid', array('model'=>$model), false, true);
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionSetScores(array $params)
	{
		$input = Yii::app()->request->getPost('input');
        // для примера будем приводить строку к верхнему регистру
	//	var_dump(Yii::app()->request->getIsAjaxRequest());
        // если запрос асинхронный, то нам нужно отдать только данные
	//	if(Yii::app()->request->isAjaxRequest)
		if(Yii::app()->request->getIsAjaxRequest())
		{
			$output = $this->setScores($params);
			echo CHtml::encode($output);
			// Завершаем приложение
			Yii::app()->end();
		}
		else
		{
			$output = $this->setScores($params);
			// если запрос не асинхронный, отдаём форму полностью
			$this->render('setScores', array(
				'input'=>$input,
				'output'=>$output,
			));
		}
		
	}
	
	protected function setScores($params)
	{
		if (isset($params['none']))
			return 'None';
		
		$result = false;
		
		$isAll = isset($params['all']);
		
		if (isset($params['count']))
		{
			$result = Yii::app()->db->createCommand()
									->select('count(*)')
								//	->select('{{battle_event}}.id')
									->from('{{battle_event}}')
									->queryScalar();
		}
		elseif (isset($params['default']))
		{
			if ($isAll)
			{
				$command = Yii::app()->db->createCommand();
				
				$result = $command->update(
											'{{battle_player}}', 
											array('destroyed_enemies' => 0,
												'destroyed_confederates' => 0,
												'score' => 0,
												'status' => 1)
										);
				
				$command->reset();
				
				$result = $command->update(
											'{{player}}', 
											array('destroyed_enemies' => 0,
												'destroyed_confederates' => 0,
												'suicides' => 0,
												'score' => 0)
										);
				
			//	$result = 'Все очки игроков обнулены.';
			}
		}
		else
		{
			if ($isAll)
			{
				$result = $this->setLimitScores();
			}
			elseif (isset($params['limit']))
			{
				$limit = $params['limit'];
				$offset = isset($params['offset']) ? $params['offset'] : null;
				
				$result = $this->setLimitScores($limit, $offset);
			}
			
		//	if ($result)
		//		$result = 'Все очки игроков установлены';
		}
		
		return $result;
	}
	
	protected function setLimitScores($limit = false, $offset = null)
	{
		$query = array(
						'select' => array('{{battle_event}}.id'),
						'from' => '{{battle_event}}'
					);
		
		if ($limit)
		{
			$query['limit'] = $limit;
			$query['offset'] = $offset;
		}
	//	var_dump($query);
		$ids = Yii::app()->db->createCommand($query)->queryAll();
		
		foreach($ids as $id)
		{
			$battleEvent = BattleEvent::model()->findByPk($id);
			
			if (!Crud::setScoresOfPlayers($battleEvent, true))
				return false;
		}
		
		return true;
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
