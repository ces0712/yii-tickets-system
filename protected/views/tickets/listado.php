<?php

/*$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

$this->menu = array(
		array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	);
*/
//Javascript para actualizar tabla dinamicamente de acuerdo a dropdownlist 

Yii::app()->clientScript->registerScript('newsletter-form', "

$('#Tickets_id_jornada').change(function(){
	$.fn.yiiGridView.update('tickets-grid', {
		data: $(this).serialize()

	});
	return false;
});
");


?>

<h3><?php echo Yii::t('app', 'Procesar') . ' ' . GxHtml::encode($model->label(2)); ?></h3>




<h1 align="left" >
<?php 

?></h1>
<div class="wide form">
	<?php 

		$form=$this->beginWidget('CActiveForm', array(
		'id'=>'newsletter-form',
		'action'=>Yii::app()->createUrl('Tickets/procesar'),
		'enableAjaxValidation'=>false,
		'method'=>'get',
	));
 	?>
 	<table style="width:100%">
	  <tr>
	    <th><?php if (isset($_GET['id_jornada'])) {
			
			$model->id_jornada = (int)$_GET['id_jornada'];

		}
		$q2 = new CDbCriteria( array(
		    'condition' => "estatus =:match order by id",         // no quotes around :match
		    'params'    => array(':match' => "true")  // Aha! Wildcards go here
		) );
		echo $form->dropDownList($model, 'id_jornada', GxHtml::listDataEx(Jornada::model()->findAll($q2),'id', 'nombre'), array('prompt'=>'Seleccione Jornada')); 

?>
</th>
	    <th><?php 
		echo GxHtml::submitButton(Yii::t('app', 'Siguiente'), array('class' => 'btn btn-primary'));  ?></th> 
	  </tr>
	 </table>


	<?php $this->endWidget();?> 
</div><!-- search-form -->

<?php 
 //echo $model->search()->getItemCount(); se creo el componente GridView para tener acceso via ajax
 //echo $model->search()->getData()[0]['cedula'].'-'.$model->search()->getData()[0]['id'];



	//$this->widget('zii.widgets.grid.CGridView', array(
	
	$this->widget('GridView', array(
	'id' => 'tickets-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		/*array(
					'name' => 'estatus',
					'value' => '($data->estatus === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),*/
		
		array(
			'name' => 'id',
			'value' => $model->id,
			'filter' => false,
		),
		array(
			'name' => 'cedula',
			'value' => $model->cedula,
			'filter' => false,
		),
		array(
			'name' => 'numero_cedula',
			'value' => $model->numero_cedula,
			'filter' => false,
		),
		/*array(
			'name' => 'rubros',
			'value' => array($this,'gridDataRubros'),
			//'filter' => GxHtml::listDataEx(Rubros::model()->findAllAttributes(null, true)),
			'filter' => false,
		),*/
		array(
			'name'=>'id_jornada',
			'value'=>'GxHtml::valueEx($data->idJornada)',
			'filter'=>false,
		),
		/*array(
			'class' => 'CButtonColumn',
			'template' => '{delete}',
		),*/
		
	),
)); ?>
