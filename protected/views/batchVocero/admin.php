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
	$.fn.yiiGridView.update('batch-vocero-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Gestionar') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'batch-vocero-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
/*		array(
					'name' => 'estatus',
					'value' => '($data->estatus === "false") ? Yii::t(\'app\', \'Inactivo\') : Yii::t(\'app\', \'Activo\')',
					'filter' => array('0' => Yii::t('app', 'Inactivo'), '1' => Yii::t('app', 'Activo')),
					),
*/		
		'fecha_referencia',
		'referencia',
		'descripcion',
		// 'saldo',
		array(
				'name'=>'id_jornada',
				'value' => array($this,'gridDataJornada'),
        'filter'=>$this->filterGridDataJornada(),
		),
		array(
				'name'=>'id_depositante',
				'value' => array($this,'gridDataDepositante'),
        'filter'=>$this->filterGridDataDepositante(),				
     ),
		'debito',
		'credito',
		/*'tipo',
		'fecha_creacion',
		array(
				'name'=>'id_procesar_archivo_vocero',
				'value'=>'GxHtml::valueEx($data->idProcesarArchivoVocero)',
				'filter'=>GxHtml::listDataEx(ProcesarArchivoVocero::model()->findAllAttributes(null, true)),
				),
		*/
		array(
			'class' => 'CButtonColumn',
		),
	),
)); ?>