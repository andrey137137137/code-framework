<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div id="main-container" class="left">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div id="sidebar-container" class="right">
		<div id="sidebar">
			<?php $this->widget('zii.widgets.CMenu',array(
				'items'=>array(
					array(
						'label'=>'Battle',
						'url'=>array('battle/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('battle/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('battle/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Battle events',
						'url'=>array('battleEvent/admin'),
					/*	'items' => array(
							array('label'=>'Create', 'url'=>array('battleEvent/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('battleEvent/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),*/
					),
					array(
						'label'=>'Battle player',
						'url'=>array('battlePlayer/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('battlePlayer/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('battlePlayer/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Caliber',
						'url'=>array('caliber/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('caliber/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('caliber/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Country',
						'url'=>array('country/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('country/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('country/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Genre',
						'url'=>array('genre/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('genre/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('genre/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Player',
						'url'=>array('player/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('player/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('player/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Destruction type',
						'url'=>array('destructionType/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('destructionType/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('destructionType/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Teem',
						'url'=>array('teem/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('teem/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('teem/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Vehicle type',
						'url'=>array('vehicleType/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('vehicleType/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('vehicleType/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Vehicle',
						'url'=>array('vehicle/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('vehicle/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('vehicle/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Priority',
						'url'=>array('priority/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('priority/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('priority/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Level',
						'url'=>array('level/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('level/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('level/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'Photo',
						'url'=>array('photo/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('photo/create'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Admin', 'url'=>array('photo/admin'), 'visible'=>!Yii::app()->user->isGuest),
						),
					),
					array(
						'label'=>'User',
						'url'=>array('user/index'),
						'items' => array(
							array('label'=>'Create', 'url'=>array('user/create')),
							array('label'=>'Admin', 'url'=>array('user/admin')),
						),
						'visible'=>!Yii::app()->user->isGuest
					),
					array(
						'label'=>'Set scores',
						'url'=>array('site/setScores', 'params' => array('none' => 1, 'all' => 1)),
						'visible'=>!Yii::app()->user->isGuest
					),
				),
			)); ?>
			<?php //if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>

			<?php /*$this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); */?>

			<?php /*$this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); */?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>