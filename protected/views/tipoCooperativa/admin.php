<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Gestionar'),
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
	$.fn.yiiGridView.update('tipo-cooperativa-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Gestionar') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'tipo-cooperativa-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
					'name' => 'estatus',
					'value' => '($data->estatus === "true") ? Yii::t(\'app\', \'Inactivo\') : Yii::t(\'app\', \'Activo\')',
					'filter' => array('0' => Yii::t('app', 'Inactivo'), '1' => Yii::t('app', 'Activo')),
					),
		array(
				'name'=>'id_responsable_cooperativa',
				'value'=>'GxHtml::valueEx($data->idResponsableCooperativa)',
				'filter'=>GxHtml::listDataEx(ResponsableCooperativa::model()->findAllAttributes(null, true)),
				),
		'tipo',
		'fecha_creacion',
		array(
			'class' => 'CButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>