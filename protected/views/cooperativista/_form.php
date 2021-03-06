<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'cooperativista-form',
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
		<?php echo $form->labelEx($model,'id_tipo_cooperativa'); ?>
		<?php echo $form->dropDownList($model, 'id_tipo_cooperativa', GxHtml::listDataEx(TipoCooperativa::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Cooperativa')); ?>
		<?php echo $form->error($model,'id_tipo_cooperativa'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'nombres_apellidos'); ?>
		<?php echo $form->textField($model, 'nombres_apellidos', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'nombres_apellidos'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'cedula'); ?>
		<?php echo $form->textField($model, 'cedula'); ?>
		<?php echo $form->error($model,'cedula'); ?>
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