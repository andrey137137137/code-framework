<div id="grid-container"></div>

<?php
	
	yii::app()->clientScript->registerScript('load-grid', ' 
		$("#grid-container").load("product/grid");
	');
	
?>