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
<script type="text/javascript">
    window.onload = setupRefresh;

    function setupRefresh() {
      setTimeout("refreshPage();", 10000); // milliseconds
    }
    function refreshPage() {
       window.location = location.href;
    }
  </script> 

<h1 align="center"><?php 

$contar = Tickets::model()->countByAttributes(array(
            'estatus'=> 'true'
        ))+1;
$campo = Tickets::model()->find('id='.$contar.'');
echo Yii::t('app', 'Ticket por atender: ') . ' ' . GxHtml::encode($contar); ?></h1>
<h1 align="center"><?php echo GxHtml::encode($campo); ?></h1>

<p align="center">"Cuando falten 30 personas antes de su turno, por favor acérquese al lugar de retiro. Agradecemos esperen el turno en su puesto de trabajo, para ver el turno"</p>
<p align="center">"Agradecemos espere en su puesto de trabajo"</p>
<p align="center">"Para ver el turno, ingrese a la siguiente pagina  tuticketclap.cantv.net"</p>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'newsletter-form',
'action'=>Yii::app()->createUrl('Tickets/procesar',array('id' => $contar)),
'enableAjaxValidation'=>false,
)); 

$this->endWidget();?> 
