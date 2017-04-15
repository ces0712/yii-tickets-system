<?php

/*$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mantenimiento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h3><?php echo Yii::t('app', 'Gestionar Mantenimiento'); ?></h3>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'mantenimiento-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
					'name' => 'estatus',
					'value' => '($data->estatus == 0) ? Yii::t(\'app\', \'Inactivo\') : Yii::t(\'app\', \'Activo\')',
					'filter' => array('0' => Yii::t('app', 'Inactivo'), '1' => Yii::t('app', 'Activo')),
					),
		// 'horaInicio',
		array(
			'class' => 'CButtonColumn',
			'template' => '{update}',
		),
	),
)); ?>
