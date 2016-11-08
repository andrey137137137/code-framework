<?php

class BattleEventController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/column2';
	
	public $prevBattleEvent = array();
	
	/**
	 * Name of directory for css files
	 * @var strign
	 */
	protected $_viewAssetSettings = array(
		
		'js' => array(
			'admin' => array(
				'setVariables' => array()
			),
			
			'update' => array(
				'setVariables' => array(
					'exceptParams' => array('selectPrevEvent' => true)
				),
				'relation' => 'create'
			)
		)
		
	);
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			array(
                'application.filters.LoadModelFilter'
            ),
			array(
                'application.filters.CorrectPostFilter + create, update, admin',
				'exceptParams' => array(
									'cascadeSave',
									'old_battle_player1_id',
									'old_battle_player2_id',
									'old_event_type',
									'old_event_direction',
									'old_destruction_type_id'
				)
            ),
			array(
                'application.filters.SetOldModelAttrsFilter + update'
            )
		);
	}
	
	/**
	 * @return array actions
	 */
	public function actions()
	{
		return array(
			'index' => array(
                'class' => 'application.actions.IndexAction'
            ),
			'view' => array(
                'class' => 'application.actions.ViewAction'
            ),
			'admin' => array(
                'class' => 'application.actions.battleEventsAdminAction'
            ),
			'create' => array(
                'class' => 'application.actions.CreateTransactionAction',
				'redirView' => 'create'
            ),
			'update' => array(
                'class' => 'application.actions.UpdateTransactionAction',
				'redirView' => 'update'
            ),
			'delete' => array(
                'class' => 'application.actions.DeleteAction'
            ),
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 
	public function actionCreate()
	{
	//	var_dump($this);
	//	$model=new BattleEvent;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$this->savePostArray($this->model, $_POST['BattleEvent']);
		
		/*
		if(isset($_POST['BattleEvent']))
		{
			$prevBattleEvent = $_POST['BattleEvent'];
			
			unset($_POST['BattleEvent']['selectPrevEvent']);
			unset($_POST['BattleEvent']['battleId']);
			unset($_POST['BattleEvent']['teem1Id']);
			unset($_POST['BattleEvent']['teem2Id']);
			unset($_POST['BattleEvent']['player1Id']);
			unset($_POST['BattleEvent']['player2Id']);
			
			$model->attributes=$_POST['BattleEvent'];
			
			if($model->save())
			{
				$prevBattleEvent['prev_event_id'] = $model->id;
				
				$this->redirect(array(
										'create',
										'prevBattleEvent'=>$prevBattleEvent
									));
			}
		}
		
		
		if(isset($_GET['prevBattleEvent']))
			$this->model->attributes=$_GET['prevBattleEvent'];
		
		$this->render('create',array(
			'model'=>$this->model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 
	public function actionUpdate($id)
	{
	//	$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$this->savePostArray($this->model, $_POST['BattleEvent'], 'update', false);
		
		/*
		if(isset($_POST['BattleEvent']))
		{
			$model->attributes=$_POST['BattleEvent'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->id));
		}
		
		
		$this->model->old_battle_player1_id = $this->model->battle_player1_id;
		$this->model->old_battle_player2_id = $this->model->battle_player2_id;
		$this->model->old_event_type = $this->model->event_type;
		$this->model->old_event_direction = $this->model->event_direction;
		$this->model->old_destruction_type_id = $this->model->destruction_type_id;
		
		$this->render('update',array(
			'model'=>$this->model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 
	protected function savePostArray($model, $post, $view = 'create', $isNewRecord = true)
	{
		if(isset($post))
		{
			if ($isNewRecord)
			{
				$this->prevBattleEvent = $post;
				unset($post['selectPrevEvent']);
			}
			else
			{
				$model->old_battle_player1_id = $post['old_battle_player1_id'];
				$model->old_battle_player2_id = $post['old_battle_player2_id'];
				$model->old_event_type = $post['old_event_type'];
				$model->old_event_direction = $post['old_event_direction'];
				$model->old_destruction_type_id = $post['old_destruction_type_id'];
				
				unset($post['old_battle_player1_id']);
				unset($post['old_battle_player2_id']);
				unset($post['old_event_type']);
				unset($post['old_event_direction']);
				unset($post['old_destruction_type_id']);
			}
			
			$model->cascadeSave = $post['cascadeSave'];
			unset($post['cascadeSave']);
			
			unset($post['battleId']);
			unset($post['teem1Id']);
			unset($post['teem2Id']);
			unset($post['player1Id']);
			unset($post['player2Id']);
			
			$model->attributes = $post;
			
			$transaction = $model->getDbConnection()->beginTransaction();
			
			try
			{
				$model->save();
				$transaction->commit();
				
				$params = array($view);
				
				if ($isNewRecord)
				{
					$prevBattleEvent['prev_event_id'] = $model->id;
					$params['prevBattleEvent'] = $prevBattleEvent;
				}
				else
					$params['id'] = $model->id;
				
				$this->redirect($params);
			}
			catch (Exception $e)
			{
				$transaction->rollback();
			}
		}
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 
	public function actionDelete($id)
	{
		$this->model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BattleEvent');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 
	public function actionAdmin()
	{
	//	$model=new BattleEvent('search');
		$this->model->unsetAttributes();  // clear any default values
		if(isset($_GET['BattleEvent']))
			$this->model->attributes=$_GET['BattleEvent'];

		$this->render('admin',array(
			'model'=>$this->model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 
	public function actionPlayersDefaults()
	{
	//	$raws = BattleEvent::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$this->savePostArray($this->model, $_POST['BattleEvent']);
		
		/*
		if(isset($_POST['BattleEvent']))
		{
			$prevBattleEvent = $_POST['BattleEvent'];
			
			unset($_POST['BattleEvent']['selectPrevEvent']);
			unset($_POST['BattleEvent']['battleId']);
			unset($_POST['BattleEvent']['teem1Id']);
			unset($_POST['BattleEvent']['teem2Id']);
			unset($_POST['BattleEvent']['player1Id']);
			unset($_POST['BattleEvent']['player2Id']);
			
			$model->attributes=$_POST['BattleEvent'];
			
			if($model->save())
			{
				$prevBattleEvent['prev_event_id'] = $model->id;
				
				$this->redirect(array(
										'create',
										'prevBattleEvent'=>$prevBattleEvent
									));
			}
		}
		
		
		if(isset($_GET['prevBattleEvent']))
			$this->model->attributes=$_GET['prevBattleEvent'];
		
		$this->render('create',array(
			'model'=>$this->model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BattleEvent the loaded model
	 * @throws CHttpException
	 
	public function loadModel($id)
	{	
		$model=BattleEvent::model()->findByPk($id);
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BattleEvent $model the model to be validated
	 
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='battle-event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}*/
}
