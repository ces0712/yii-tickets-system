<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'depositante-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Campos con'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'son requeridos'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'estatus'); ?>
		<?php echo $form->checkBox($model, 'estatus'); ?>
		<?php echo $form->error($model,'estatus'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'cedula'); ?>
		<?php echo $form->textField($model, 'cedula'); ?>
		<?php echo $form->error($model,'cedula'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'nombres_apellidos'); ?>
		<?php echo $form->textField($model, 'nombres_apellidos', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'nombres_apellidos'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>
</div><!-- form -->
