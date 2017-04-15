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
	$.fn.yiiGridView.update('jornada-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Gestionar') . ' ' . GxHtml::encode($model->label(2)); ?></h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'jornada-grid',
	'dataProvider' => $model->searchJornadaRubro(),
	'filter' => $model,
	'columns' => array(
		array(
					'name' => 'estatus',
					'value' => '($data->estatus === "true") ? Yii::t(\'app\', \'Inactivo\') : Yii::t(\'app\', \'Activo\')',
					'filter' => array('0' => Yii::t('app', 'Inactivo'), '1' => Yii::t('app', 'Activo')),
					),
		'nombre',
		array('name'=>'monto','value'=>'$data->monto','filter'=>'',),
		array(
			'class' => 'CButtonColumn',
			'template'=>'{editar}',
			'buttons'=>array
                        (
                                'editar' => array
                                (
                                        'label'=>'Actualizar Jornada',
                                        'imageUrl'=>Yii::app()->theme->baseUrl.'/img/icons/smashing/30px-41.png',
                                        'url'=>'Yii::app()->createUrl("jornada/updateJornada", array("ids"=>$data->ids))',
                                ),
                        ),

		),
	),
)); ?>
