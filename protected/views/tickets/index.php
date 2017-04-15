<?php

/*$this->breadcrumbs = array(
	Tickets::label(2),
	Yii::t('app', 'Index'),
);

$this->menu = array(
	array('label'=>Yii::t('app', 'Create') . ' ' . Tickets::label(), 'url' => array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . Tickets::label(2), 'url' => array('admin')),
);*/
?>

<h1 align="right" ><?php 

$contar = Tickets::model()->countByAttributes(array(
            'estatus'=> 'true'
        ))+1;
$campo = Tickets::model()->find('id='.$contar.'');
echo Yii::t('app', 'Ticket por atender: ') . ' ' . GxHtml::encode($contar); ?></h1>
<h1><?php echo GxHtml::encode($campo); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'newsletter-form',
'action'=>Yii::app()->createUrl('Tickets/procesar',array('id' => $contar)),
'enableAjaxValidation'=>false,
)); 
echo GxHtml::submitButton(Yii::t('app', 'Siguiente'));

$this->endWidget();?> 
