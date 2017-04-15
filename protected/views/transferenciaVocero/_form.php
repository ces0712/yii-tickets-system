<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'transferencia-vocero-form',
	'enableAjaxValidation' => true,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Campos con'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'son requeridos'); ?>.
	</p>


	<?php echo $form->errorSummary($model); ?>
		<div class="row">
		<?php echo $form->labelEx($model,'id_jornada'); ?>
		<?php echo $form->dropDownList($model, 'id_jornada', $this->filterGridDataJornada(),array('prompt' => 'Seleccione Jornada')); ?>
		<?php echo $form->error($model,'id_jornada'); ?>
		</div><!-- row -->

		<div class="row">
		<?php echo $form->labelEx($model,'id_vocero_emisor'); ?>
		<?php echo $form->dropDownList($model, 'id_vocero_emisor', $this->getVocero('e',$model) ,array('prompt' => 'Seleccione un vocero')); ?>
		<?php echo $form->error($model,'id_vocero_emisor'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_vocero_receptor'); ?>
		<?php echo $form->dropDownList($model, 'id_vocero_receptor', $this->getVocero('r',$model) ,array('prompt' => 'Seleccione un vocero')); ?>
		<?php echo $form->error($model,'id_vocero_receptor'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_depositante'); ?>
		<?php // echo $form->dropDownList($model, 'id_depositante', GxHtml::listDataEx(Depositante::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Titular Cuenta')); 
		$this->widget('zii.widgets.jui.CJuiAutoComplete',
		      array(
		      // 'name'=>'depositante',
		      'model'=>$model,
		      'attribute'=>'nombres_apellidos',
		      'source'=>Yii::app()->createUrl('transferenciaVocero/autocompleteDepositante'),
		       
		      'options'=>array(
		      'showAnim'=>'fold',
		      'search' => 'js:function(event, ui){
		                        $(\'#TransferenciaVocero_id_depositante\').val();
		                       }',
		                        'select' => 'js:function(event, ui){
		                            var res = ui.item.value.split("-");
		                            $(\'#TransferenciaVocero_id_depositante\').val(res[0]);
		                        }',
		                    
		      ),
		       
		      'htmlOptions'=>array(
		      'style'=>'width: 400px;',
		      ),
		    ));


		?>
		<?php echo $form->hiddenField($model,'id_depositante'); ?>
		<?php echo $form->error($model,'id_depositante'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'id_banco'); ?>
		<?php echo $form->dropDownList($model, 'id_banco', $this->filterGridDataBanco(),array('prompt' => 'Seleccione banco')); ?>
		<?php echo $form->error($model,'id_banco'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'referencia_bancaria'); ?>
		<?php echo $form->textField($model, 'referencia_bancaria', array('maxlength' => 100)); ?>
		<?php echo $form->error($model,'referencia_bancaria'); ?>
		</div><!-- row -->
		<div class="row">
		<?php // echo $form->labelEx($model,'id_estado'); ?>
		<?php // echo  $form->dropDownList($model, 'id_estado', GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true))); ?>
		<?php // echo $form->error($model,'id_estado'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'monto_transferido'); ?>
		<?php $this->getMontoTransferido($model,$form); ?>
		<?php echo $form->error($model,'monto_transferido'); ?>
		</div><!-- row -->


<?php
echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));
$this->endWidget();
?>
</div><!-- form -->
