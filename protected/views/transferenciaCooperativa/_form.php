<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'transferencia-cooperativa-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'id_jornada'); ?>
		<?php echo $form->dropDownList($model, 'id_jornada', GxHtml::listDataEx(Jornada::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_jornada'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_cooperativista'); ?>
		<?php echo $form->dropDownList($model, 'id_cooperativista', GxHtml::listDataEx(Cooperativista::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_cooperativista'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_banco'); ?>
		<?php echo $form->dropDownList($model, 'id_banco', GxHtml::listDataEx(Bancos::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_banco'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'referencia_bancaria'); ?>
		<?php echo $form->textField($model, 'referencia_bancaria', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'referencia_bancaria'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_estado'); ?>
		<?php echo $form->dropDownList($model, 'id_estado', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_estado'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'fecha_creacion'); ?>
		<?php echo $form->textField($model, 'fecha_creacion'); ?>
		<?php echo $form->error($model,'fecha_creacion'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'monto_transferido'); ?>
		<?php echo $form->textField($model, 'monto_transferido'); ?>
		<?php echo $form->error($model,'monto_transferido'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_depositante'); ?>
		<?php echo $form->dropDownList($model, 'id_depositante', GxHtml::listDataEx(Depositante::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_depositante'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_vocero'); ?>
		<?php echo $form->dropDownList($model, 'id_vocero', GxHtml::listDataEx(Vocero::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'id_vocero'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->