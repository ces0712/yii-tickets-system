<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Consultar'),
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
	$.fn.yiiGridView.update('transferencia-cooperativa-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Consultar') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'transferencia-cooperativa-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
				'name'=>'id_jornada',
				'value' => array($this,'gridDataJornada'),
        'filter'=>$this->filterGridDataJornada(),				
    ),
		array(
				'name'=>'id_cooperativista',
				'value'=>'GxHtml::valueEx($data->idCooperativista)',
				'filter'=>GxHtml::listDataEx(Cooperativista::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'id_banco',
        'value' => array($this,'gridDataBanco'),
        'filter'=>$this->filterGridDataBanco(),				
    ),
		'referencia_bancaria',
		array(
				'name'=>'id_estado',
				'value'=>'GxHtml::valueEx($data->idEstado)',
				'filter'=>GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
				),
		
		'fecha_creacion',
		'monto_transferido',
		array(
				'name'=>'id_depositante',
				'value'=>'GxHtml::valueEx($data->idDepositante)',
				'filter'=>GxHtml::listDataEx(Depositante::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'id_vocero',
				'value' => array($this,'gridDataVoceros'),
				'filter'=>$this->filterGridDataVoceros(),
		),
		/*array(
			'class' => 'CButtonColumn',
		),
		*/
	),
)); ?>