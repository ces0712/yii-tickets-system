<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'bancos-form',
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
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textArea($model, 'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
		</div><!-- row -->
		<div class="row">
		<?php // echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php // echo $form->textField($model, 'fecha_creacion'); ?>
		<?php // echo $form->error($model,'fecha_creacion'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));

$this->endWidget();
?>
</div><!-- form -->
