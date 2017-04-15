<?php

/*$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);*/
?>

<h1><?php echo Yii::t('app', 'Ticket Creado Exitosamente') ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'cedula',
'numero_cedula',
'bauche',
'p00',
'monto',
array(
			'name' => 'idDepositante',
			'type' => 'raw',
			'value' => $model->idDepositante !== null ? GxHtml::encode(GxHtml::encode(GxHtml::valueEx($model->idDepositante)), array('depositante/view', 'id' => GxActiveRecord::extractPkValue($model->idDepositante, true))) : null,
			),
array(
			'name' => 'idBanco',
			'type' => 'raw',
			'value' => $model->idBanco !== null ? GxHtml::encode(GxHtml::encode(GxHtml::valueEx($model->idBanco)), array('bancos/view', 'id' => GxActiveRecord::extractPkValue($model->idBanco, true))) : null,
			),
array(
			'name' => 'idVocero',
			'type' => 'raw',
			'value' => CHtml::encode($model->vocero),
			),
array(
			'name' => 'idJornada',
			'type' => 'raw',
			'value' => $model->idJornada !== null ? GxHtml::encode(GxHtml::encode(GxHtml::valueEx($model->idJornada)), array('jornada/view', 'id' => GxActiveRecord::extractPkValue($model->idJornada, true))) : null,
			),
'observacion_vocero',

	),
)); ?>

