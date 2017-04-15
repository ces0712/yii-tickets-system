<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			//	array('label'=>'Registrar Pago', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			//	array('label'=>'Home', 'url'=>array('/site/index')),
			//	array('label'=>'Estatus', 'url'=>array('/site/index')),
				array('label'=>'Gestionar Tickets', 'url'=>array('/tickets/admin')),
				array('label'=>'Gestionar Bloqueos', 'url'=>array('/bloqueos/admin')),
				array('label'=>'Procesar Ticket', 'url'=>array('/tickets/listado')),
			//	array('label'=>'Procesar Ticket', 'url'=>array('/tickets/index')),
			//	array('label'=>'Listado Tickets', 'url'=>array('/tickets/admin')),
			//  array('label'=>'Crear Tickets', 'url'=>array('/tickets/create')),
			  array('label'=>'Gestionar Rubros', 'url'=>array('/rubros/admin')),
			  array('label'=>'Gestionar Mantenimiento', 'url'=>array('/mantenimiento/admin')),
			//  array('label'=>'Gestionar Flujo', 'url'=>array('/estados/admin')),
			//	array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php /*$this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); */?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> CANTV.<br/>
		.<br/>

	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
