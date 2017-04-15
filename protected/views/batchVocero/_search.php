<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'estatus'); ?>
		<?php echo $form->dropDownList($model, 'estatus', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fecha_referencia'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model, 'referencia'); ?>
		<?php echo $form->textArea($model, 'referencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'descripcion'); ?>
		<?php echo $form->textArea($model, 'descripcion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'saldo'); ?>
		<?php echo $form->textArea($model, 'saldo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'debito'); ?>
		<?php echo $form->textArea($model, 'debito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'credito'); ?>
		<?php echo $form->textArea($model, 'credito'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tipo'); ?>
		<?php echo $form->textArea($model, 'tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fecha_creacion'); ?>
		<?php echo $form->textField($model, 'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_procesar_archivo_vocero'); ?>
		<?php echo $form->dropDownList($model, 'id_procesar_archivo_vocero', GxHtml::listDataEx(ProcesarArchivoVocero::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
