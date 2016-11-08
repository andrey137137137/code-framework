<?php

class CountryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			array(
                'application.filters.LoadModelFilter',
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
                'class' => 'application.actions.AdminAction'
            ),
			'create' => array(
                'class' => 'application.actions.CreateAction'
            ),
			'update' => array(
                'class' => 'application.actions.UpdateAction'
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
}
