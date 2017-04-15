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
	$.fn.yiiGridView.update('tickets-grid', {
		data: $(this).serialize()
	});
	return false;
});
");*/
?>

<h1><?php echo Yii::t('app', 'Consolidado') . ' ' . GxHtml::encode($model->label(2)) . ' por Vocero';  ?></h1>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'tickets-grid',
	'dataProvider' => $model->search_por_verificar(),
	'filter' => $model,
	'pager'=>'LinkPager',
	'columns' => array(
		'id',
		array(
				'name'=>'id_vocero',
				'value' => array($this,'gridDataVoceros'),
				'filter'=>$this->filterGridDataVoceros(),
		),
		/*array(
					'name' => 'estatus',
					'value' => '($data->estatus === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),*/
		'cedula',
		'bauche',
		'p00',
		array(
				'name'=>'id_banco',
				'value'=>'GxHtml::valueEx($data->idBanco)',
				'filter'=>GxHtml::listDataEx(Bancos::model()->findAllAttributes(null, true)),
				),
		array(
			'name' => 'rubros',
			'value' => array($this,'gridDataRubros'),
			'filter' => GxHtml::listDataEx(Rubros::model()->findAllAttributes(null, true)),
		),
		array(
				'name'=>'estado_flujo',
				'value'=>'GxHtml::valueEx($data->estadoFlujo)',
				'filter'=>GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
		),
		array(
    			'class'=>'CButtonColumn',
    			'template'=>'{editar}',
    			'buttons'=>array
    			(
        			'editar' => array
        			(
            				'label'=>'Actualizar Tickets por Vocero',
            				'imageUrl'=>Yii::app()->theme->baseUrl.'/img/icons/smashing/30px-41.png',
            				'url'=>'Yii::app()->createUrl("tickets/updateTicketsVocero", array("id"=>$data->id))',
        			),
    			),
		), 
	),

)); ?>
