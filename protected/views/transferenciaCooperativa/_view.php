<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id_jornada')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idJornada)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_cooperativista')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idCooperativista)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_banco')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idBanco)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('referencia_bancaria')); ?>:
	<?php echo GxHtml::encode($data->referencia_bancaria); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_estado')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idEstado)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:
	<?php echo GxHtml::encode($data->fecha_creacion); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('monto_transferido')); ?>:
	<?php echo GxHtml::encode($data->monto_transferido); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_depositante')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idDepositante)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_vocero')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idVocero)); ?>
	<br />
	*/ ?>

</div>