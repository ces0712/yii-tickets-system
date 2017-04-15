<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<h1>Inicio de Sesion</h1>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'tipoempleado'); ?>
		<?php $tipoempleado=Tipoempleado::model()->findAll();
		$listatipo = CHtml::listData($tipoempleado,'id_tipo_empleado', 'tipo_empleado');
		echo $form->dropDownList(Tipoempleado::model(), 'id_tipo_empleado',$listatipo,array(
                'prompt'=>"seleccione",
                'class'=>'span5',
                ) ); 
		echo $form->error(Tipoempleado::model(),'id_tipo_empleado');?>
	</div>
	

<!--	<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div> -->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Iniciar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
