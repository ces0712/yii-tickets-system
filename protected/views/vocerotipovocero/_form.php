<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'vocerotipovocero-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Campos con'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'son requeridos'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'id_vocero'); ?>
		<?php echo $form->dropDownList($model, 'id_vocero', GxHtml::listDataEx(Vocero::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione un vocero')); ?>
		<?php echo $form->error($model,'id_vocero'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'ids_tipo_vocero'); ?>
		<?php // echo $form->dropDownList($model, 'id_tipo_vocero', GxHtml::listDataEx(TipoVocero::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->checkBoxList($model, 'ids_tipo_vocero', GxHtml::encodeEx(GxHtml::listDataEx(TipoVocero::model()->findAllAttributes(null, true)), false, true)); ?>
		<?php // echo $form->error($model,'id_tipo_vocero'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
// echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->
