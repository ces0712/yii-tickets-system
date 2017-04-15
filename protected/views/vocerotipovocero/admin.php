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
	$.fn.yiiGridView.update('vocerotipovocero-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Gestionar') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'vocerotipovocero-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
				'name'=>'id_vocero',
				'value'=>'GxHtml::valueEx($data->idVocero)',
				'filter'=>GxHtml::listDataEx(Vocero::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'id_tipo_vocero',
				'value'=>'GxHtml::valueEx($data->idTipoVocero)',
				'filter'=>GxHtml::listDataEx(TipoVocero::model()->findAllAttributes(null, true)),
				),
		array(
			'class' => 'CButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>
