<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'estatus:boolean',
'nombres',
'apellidos',
'cedula',
'fecha_creacion',
array(
			'name' => 'idSede',
			'type' => 'raw',
			'value' => $model->idSede !== null ? GxHtml::encode(GxHtml::encode(GxHtml::valueEx($model->idSede)), array('sede/view', 'id' => GxActiveRecord::extractPkValue($model->idSede, true))) : null,
			),
array(
			'name' => 'idEdificio',
			'type' => 'raw',
			'value' => $model->idEdificio !== null ? GxHtml::encode(GxHtml::encode(GxHtml::valueEx($model->idEdificio)), array('edificio/view', 'id' => GxActiveRecord::extractPkValue($model->idEdificio, true))) : null,
			),
array(
			'name' => 'idPiso',
			'type' => 'raw',
			'value' => $model->idPiso !== null ? GxHtml::encode(GxHtml::encode(GxHtml::valueEx($model->idPiso)), array('piso/view', 'id' => GxActiveRecord::extractPkValue($model->idPiso, true))) : null,
			),



),
)); ?>

