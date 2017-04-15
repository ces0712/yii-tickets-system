<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'transferencia-vocero-form',
	'enableAjaxValidation' => false,
	'enableClientValidation'=>true,
    	'clientOptions'=>array(
        /* When false, the rules are run at the same time */
        /* When true at the same time than enableClientValidation,
            custom rules run after all the standard ones are cleared */
        'validateOnSubmit'=>true,
    ),
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Campos con'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'son requeridos'); ?>.
	</p>


	<?php echo $form->errorSummary($model); ?>
		<div class="row">
		<?php echo $form->labelEx($model,'id_jornada'); ?>
		<?php echo $form->dropDownList($model, 'id_jornada', GxHtml::listDataEx(Jornada::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Jornada')); ?>
		<?php echo $form->error($model,'id_jornada'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($model,'id_vocero_receptor'); ?>
		<?php echo $form->dropDownList($model, 'id_vocero_receptor', $this->getVocero('r',$model) ,array('prompt' => 'Seleccione un vocero')); ?>
		<?php echo $form->error($model,'id_vocero_receptor'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_vocero_emisor'); ?>
		<?php echo $form->ListBox($model,'id_vocero_emisor',$this->getVocero('e',$model),array('prompt' => 'Seleccione un vocero')); ?>
		<?php echo $form->error($model,'id_vocero_emisor'); ?>
		</div><!-- row -->
    <div class="row">
    <?php echo $form->labelEx($model,'id_depositante'); ?>
    <?php echo $form->dropDownList($model, 'id_depositante', GxHtml::listDataEx(Depositante::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Titular de Cuenta')); ?>
    <?php echo $form->error($model,'id_depositante'); ?>
    </div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_banco'); ?>
		<?php echo $form->dropDownList($model, 'id_banco', GxHtml::listDataEx(Bancos::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione banco')); ?>
		<?php echo $form->error($model,'id_banco'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'referencia_bancaria'); ?>
		<?php echo $form->textField($model, 'referencia_bancaria', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'referencia_bancaria'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->hiddenField($model, 'id_estado'); ?>
		<?php // echo $form->labelEx($model,'id_estado'); ?>
		<?php // echo  $form->dropDownList($model, 'id_estado', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true))); ?>
		<?php // echo $form->error($model,'id_estado'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'monto_transferido'); ?>
		<?php echo $form->textField($model, 'monto_transferido'); ?>
		<?php echo $form->error($model,'monto_transferido'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();

$request_url = Yii::app()->createUrl('transferenciaVocero/setFromVoceroEmisor');
// $request_url = $this->createUrl('setFromVoceroEmisor');
$js = "$('#TransferenciaVocero_id_vocero_emisor').on('change', function(obj){
        var parent_select = $(this);
        $.ajax({
                url: '$request_url',
                method: 'POST',
		dataType: 'json',
		data: {id_vocero_emisor:$('#TransferenciaVocero_id_vocero_emisor').val(), id_jornada:$('#TransferenciaVocero_id_jornada').val(),id_vocero_receptor:$('#TransferenciaVocero_id_vocero_receptor').val(), id_estado:$('#TransferenciaVocero_id_estado').val()},
                success: function(data, textStatus, jqXHR){
      $('#TransferenciaVocero_id_depositante').val(data.id_depositante);         
			$('#TransferenciaVocero_id_banco').val(data.id_banco);
			$('#TransferenciaVocero_referencia_bancaria').val(data.referencia_bancaria);
			$('#TransferenciaVocero_monto_transferido').val(data.monto_transferido);
                }
        });
})";

Yii::app()->getClientScript()->registerScript('js', $js, CClientScript::POS_END);


?>
</div><!-- form -->
