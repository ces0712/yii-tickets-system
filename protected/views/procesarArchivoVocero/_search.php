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
		<?php echo $form->label($model, 'nombre'); ?>
		<?php echo $form->textArea($model, 'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_estado'); ?>
		<?php echo $form->textField($model, 'id_estado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_jornada'); ?>
		<?php echo $form->textField($model, 'id_jornada'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_depositante'); ?>
		<?php echo $form->textField($model, 'id_depositante'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fecha_creacion'); ?>
		<?php echo $form->textField($model, 'fecha_creacion'); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
