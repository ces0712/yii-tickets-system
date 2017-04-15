<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'tickets-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Los Campos con'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'son obligatorios'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php // echo $form->labelEx($model,'estatus'); ?>
		<?php // echo $form->checkBox($model, 'estatus'); ?>
		<?php // echo $form->error($model,'estatus'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'cedula'); ?>
		<?php echo $form->textField($model, 'cedula'); ?>
		<?php echo $form->error($model,'cedula'); ?>
		</div><!-- row -->
		<div class="row">
		<?php // echo $form->labelEx($model,'estado_flujo'); ?>
		<?php // echo $form->dropDownList($model, 'estado_flujo', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true))); ?>
		<?php // echo $form->error($model,'estado_flujo'); ?>
		</div><!-- row -->
		<div class="row">
		<?php // echo $form->labelEx($model,'numero_cedula'); ?>
		<?php // echo $form->textArea($model, 'numero_cedula'); ?>
		<?php // echo $form->error($model,'numero_cedula'); ?>
		</div><!-- row -->
                <div class="row">
                <?php echo $form->labelEx($model,'id_banco'); ?>
                <?php echo $form->dropDownList($model, 'id_banco', $this->filterGridDataBanco()); ?>
                <?php echo $form->error($model,'id_banco'); ?>
                </div><!-- row -->
                <div class="row">
                <?php echo $form->labelEx($model,'id_vocero'); ?>
                <?php
                    $models = Vocero::model()->findAll();
                    $data = array();

                    foreach ($models as $model_vocero)
                        $data[$model_vocero->id] = $model_vocero->nombres . ' '. $model_vocero->apellidos;

                echo $form->dropDownList($model, 'id_vocero', $data ,array('prompt' => 'Seleccione un vocero'));
                // echo $form->dropDownList($model, 'id_vocero', GxHtml::listDataEx(Vocero::model()->findAllAttributes(null, true)));
                ?>
                <?php echo $form->error($model,'id_vocero'); ?>
                </div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_depositante'); ?>
		<?php echo $form->dropDownList($model, 'id_depositante', GxHtml::listDataEx(Depositante::model()->findAllAttributes(null, true)), array('prompt' => 'Seleccione depositante')); ?>
		<?php echo $form->error($model,'id_depositante'); ?>
		</div><!-- row -->

                <div class="row">
                <?php echo $form->labelEx($model,'id_jornada'); ?>
                <?php echo $form->dropDownList($model, 'id_jornada', $this->filterGridDataJornada(), array('prompt' => 'Seleccione Jornada')); ?>
                <?php echo $form->error($model,'id_jornada'); ?>
                </div><!-- row -->
                <div class="row">
                <?php echo $form->labelEx($model,'bauche'); ?>
                <?php echo $form->textField($model, 'bauche', array('maxlength' => 30)); ?>
                <?php echo $form->error($model,'bauche'); ?>
                </div><!-- row -->
		<div class="row">
                <?php echo $form->labelEx($model,'p00'); ?>
                <?php echo $form->textField($model, 'p00'); ?>
                <?php echo $form->error($model,'p00'); ?>
                </div><!-- row -->
                <div class="row">
                <?php echo $form->labelEx($model,'monto'); ?>
                <?php echo $form->textField($model, 'monto'); ?>
                <?php echo $form->error($model,'monto'); ?>
                </div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'atencion_preferencial'); ?>
		<?php echo $form->checkBox($model, 'atencion_preferencial'); ?>
		<?php echo $form->error($model,'atencion_preferencial'); ?>
		</div><!-- row -->




<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>
</div><!-- form -->
