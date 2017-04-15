<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'vocero-form',
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
		<?php echo $form->labelEx($model,'nombres'); ?>
		<?php echo $form->textField($model, 'nombres'); ?>
		<?php echo $form->error($model,'nombres'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'apellidos'); ?>
		<?php echo $form->textField($model, 'apellidos'); ?>
		<?php echo $form->error($model,'apellidos'); ?>
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
		<div class="row">
		<?php echo $form->labelEx($model,'id_sede'); ?>
		<?php echo $form->dropDownList($model, 'id_sede', GxHtml::listDataEx(Sede::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Sede')); ?>
		<?php echo $form->error($model,'id_sede'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_edificio'); ?>
		<?php echo $form->dropDownList($model, 'id_edificio', GxHtml::listDataEx(Edificio::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Edificio')); ?>
		<?php echo $form->error($model,'id_edificio'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_piso'); ?>
		<?php echo $form->dropDownList($model, 'id_piso', GxHtml::listDataEx(Piso::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Piso')); ?>
		<?php echo $form->error($model,'id_piso'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ids_tipo_vocero'); ?>
		<?php echo $form->checkBoxList($model, 'ids_tipo_vocero', GxHtml::encodeEx(GxHtml::listDataEx(TipoVocero::model()->findAllAttributes(null, true)), false, true)); ?>
		</div><!-- row -->
		

<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>
</div><!-- form -->
