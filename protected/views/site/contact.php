<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<h1>Usuario Registrado</h1>




<h2>
Usted ya se encuentra registrado Sus datos son los siguientes: 
</h2>

<?php
$fecha = Yii::app()->session['fecha'];
$cedula = Yii::app()->session['cedula'];
$nombre = Yii::app()->session['nombre'];
$voucher = Yii::app()->session['voucher'];
if ($fecha == '' && $voucher == '' && $cedula == '' && $nombre == ''){

	 $this->redirect(Yii::app()->homeUrl);
	 Yii::app()->session->clear();
       	 Yii::app()->session->destroy();
	
	 exit();
}

?> 
<h3>Cedula: <?php echo $cedula?> </h3>
<h3>Nombre: <?php echo $nombre?> </h3>
<h3>Numero de Voucher o Transferencia: <?php echo $voucher?> </h3>
<h3>Fecha de tu Jornada: <?php echo $fecha?> </h3>
<?php   
	Yii::app()->session->clear();
	Yii::app()->session->destroy();
 ?>
