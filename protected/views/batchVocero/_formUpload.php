<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'batch-vocero-form',
	'enableAjaxValidation' => false,
	'method'=>'post',
  'htmlOptions'=>array(
      'enctype'=>'multipart/form-data'
   )
));
?>
<?php 
	if (count($model->message) > 0) {
		foreach ($model->message as $key => $value) {
			foreach ($value as $m) {
				if ($key !== 'warning') {
					echo '<div class="alert alert-'.$key.'">'.$m."</div>\n";
				} else
					echo '<div class="alert">'.$m."</div>\n";

			}
		}
	}
?>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'id_jornada'); ?>
		<?php echo $form->dropDownList($model, 'id_jornada', $this->filterGridDataJornada(), array('prompt' => 'Seleccione jornada')); ?>
		<?php echo $form->error($model,'id_jornada'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_depositante'); ?>
		<?php echo $form->dropDownList($model, 'id_depositante', GxHtml::listDataEx(Depositante::model()->findAllAttributes(null, true)), array('prompt' => 'Seleccione Titular')); ?>
		<?php echo $form->error($model,'id_depositante'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
		</div><!-- row -->

<?php
echo GxHtml::submitButton(Yii::t('app', 'Iniciar Carga'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>

</div><!-- form -->

