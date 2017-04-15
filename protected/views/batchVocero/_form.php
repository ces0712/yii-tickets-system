<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'batch-vocero-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'estatus'); ?>
		<?php echo $form->checkBox($model, 'estatus'); ?>
		<?php echo $form->error($model,'estatus'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'fecha_referencia'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'fecha_referencia',
			'value' => $model->fecha_referencia,
			'options' => array(
				'showButtonPanel' => true,
				'changeYear' => true,
				'dateFormat' => 'yy-mm-dd',
				),
			));
; ?>
		<?php echo $form->error($model,'fecha_referencia'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'referencia'); ?>
		<?php echo $form->textArea($model, 'referencia'); ?>
		<?php echo $form->error($model,'referencia'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'descripcion'); ?>
		<?php echo $form->textArea($model, 'descripcion'); ?>
		<?php echo $form->error($model,'descripcion'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'saldo'); ?>
		<?php echo $form->textArea($model, 'saldo'); ?>
		<?php echo $form->error($model,'saldo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'debito'); ?>
		<?php echo $form->textArea($model, 'debito'); ?>
		<?php echo $form->error($model,'debito'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'credito'); ?>
		<?php echo $form->textArea($model, 'credito'); ?>
		<?php echo $form->error($model,'credito'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->textArea($model, 'tipo'); ?>
		<?php echo $form->error($model,'tipo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model, 'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_procesar_archivo_vocero'); ?>
		<?php echo $form->dropDownList($model, 'id_procesar_archivo_vocero', GxHtml::listDataEx(ProcesarArchivoVocero::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_procesar_archivo_vocero'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->