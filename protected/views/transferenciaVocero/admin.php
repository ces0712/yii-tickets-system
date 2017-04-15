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
	$.fn.yiiGridView.update('transferencia-vocero-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app', 'Gestionar') . ' ' . GxHtml::encode($model->label(2)); ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'transferencia-vocero-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
				'name'=>'id_jornada',
				'value' => array($this,'gridDataJornada'),
        'filter'=>$this->filterGridDataJornada(),				
    ),
		/*array(
				'name'=>'id_vocero_emisor',
				'value' => array($this,'gridDataVocerosEmisor'),
                                'filter'=>$this->filterGridDataVoceros(),
				),*/
		array(
				'name'=>'id_vocero_receptor',
				'value' => array($this,'gridDataVocerosReceptor'),
        'filter'=>$this->filterGridDataVoceros(),
				),
		/*'referencia_bancaria',
		array(
				'name'=>'id_banco',
				'value' => array($this,'gridDataBanco'),
        'filter'=>$this->filterGridDataBanco(),				
    ),
		*/
		array(
				'name'=>'id_estado',
				'value'=>'GxHtml::valueEx($data->idEstado)',
				'filter'=>GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
				),
		
		// 'fecha_creacion',
		
		array(
			'class' => 'CButtonColumn',
			'template'=>'{update}{avanzar}',
			'buttons'=>array
                        (
                                'avanzar' => array
                                (
                                        'label'=>'Avanzar Estatus',
                                        'imageUrl'=>Yii::app()->theme->baseUrl.'/img/icons/smashing/30px-12.png',
                                        'url'=>'Yii::app()->createUrl("transferenciaVocero/avanzarTransferenciaVocero", array("id"=>$data->id))',
                                ),

                        ),

		),
	),
)); ?>
