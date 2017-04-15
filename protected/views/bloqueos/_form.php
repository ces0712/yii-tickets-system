<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'bloqueos-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Coloque el campo tiempo en minutos'); ?>.
	</p>

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
		<div class="row">
		<?php echo $form->labelEx($model,'tiempo'); ?>
		<?php echo $form->textField($model, 'tiempo'); ?>
		<?php echo $form->error($model,'tiempo'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>
</div><!-- form -->
