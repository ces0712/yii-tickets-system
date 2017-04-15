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
		<?php echo $form->label($model, 'id_vocero_emisor'); ?>
		<?php echo $form->dropDownList($model, 'id_vocero_emisor', GxHtml::listDataEx(Vocero::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_vocero_receptor'); ?>
		<?php echo $form->dropDownList($model, 'id_vocero_receptor', GxHtml::listDataEx(Vocero::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'referencia_bancaria'); ?>
		<?php echo $form->textField($model, 'referencia_bancaria', array('maxlength' => 100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_banco'); ?>
		<?php echo $form->dropDownList($model, 'id_banco', GxHtml::listDataEx(Bancos::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_estado'); ?>
		<?php echo $form->dropDownList($model, 'id_estado', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fecha_creacion'); ?>
		<?php echo $form->textField($model, 'fecha_creacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'id_jornada'); ?>
		<?php echo $form->dropDownList($model, 'id_jornada', GxHtml::listDataEx(Jornada::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row buttons">
		<?php echo GxHtml::submitButton(Yii::t('app', 'Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
