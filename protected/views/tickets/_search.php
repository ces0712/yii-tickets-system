<div class="wide form">

<?php $form = $this->beginWidget('GxActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>

	<div class="row">
		<?php // echo $form->label($model, 'id'); ?>
		<?php // echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php // echo $form->label($model, 'estatus'); ?>
		<?php // echo $form->dropDownList($model, 'estatus', array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php // echo $form->label($model, 'cedula'); ?>
		<?php // echo $form->textField($model, 'cedula'); ?>
	</div>

	<div class="row">
		<?php // echo $form->label($model, 'numero_cedula'); ?>
		<?php // echo $form->textArea($model, 'numero_cedula'); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model, 'rubros'); ?>
		<?php echo $form->dropDownList($model, 'rubros', GxHtml::listDataEx(Rubros::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php // echo $form->label($model, 'estado_flujo'); ?>
		<?php // echo $form->dropDownList($model, 'estado_flujo', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
