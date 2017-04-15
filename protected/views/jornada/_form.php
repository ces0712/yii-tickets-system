<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'jornada-form',
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
		<?php echo $form->textField($model, 'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
		</div><!-- row -->
		<div class="row">
		<?php // echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php // echo $form->textField($model, 'fecha_creacion'); ?>
		<?php // echo $form->error($model,'fecha_creacion'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'monto_estimado'); ?>
		<?php echo $form->textField($model, 'monto_estimado'); ?>
		<?php echo $form->error($model,'monto_estimado'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ids_rubro'); ?>
		<?php // echo $form->dropDownList($model, 'id_rubro', GxHtml::listDataEx(Rubros::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->checkBoxList($model, 'ids_rubro', GxHtml::encodeEx(GxHtml::listDataEx(Rubros::model()->findAllAttributes(null, true)), false, true)); ?>
		<?php // echo $form->error($model,'id_rubro'); ?>
		</div><!-- row -->



<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>
</div><!-- form -->
