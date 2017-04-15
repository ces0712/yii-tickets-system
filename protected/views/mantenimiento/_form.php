<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'mantenimiento-form',
	'enableAjaxValidation' => true,
));
?>


	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'estatus'); ?>
		<?php echo $form->checkBox($model, 'estatus'); ?>
		<?php echo $form->error($model,'estatus'); ?>
		</div><!-- row -->
		<div class="row">
		<?php // echo $form->labelEx($model,'horaInicio'); ?>
		<?php // echo $form->textField($model, 'horaInicio'); ?>
		<?php // echo $form->error($model,'horaInicio'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>
</div><!-- form -->
