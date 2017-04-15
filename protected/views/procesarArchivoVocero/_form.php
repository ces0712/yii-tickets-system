<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'procesar-archivo-vocero-form',
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
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textArea($model, 'nombre'); ?>
		<?php echo $form->error($model,'nombre'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_estado'); ?>
		<?php echo $form->textField($model, 'id_estado'); ?>
		<?php echo $form->error($model,'id_estado'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_jornada'); ?>
		<?php echo $form->textField($model, 'id_jornada'); ?>
		<?php echo $form->error($model,'id_jornada'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_depositante'); ?>
		<?php echo $form->textField($model, 'id_depositante'); ?>
		<?php echo $form->error($model,'id_depositante'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model, 'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('batchVoceros')); ?></label>
		<?php echo $form->checkBoxList($model, 'batchVoceros', GxHtml::encodeEx(GxHtml::listDataEx(BatchVocero::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->