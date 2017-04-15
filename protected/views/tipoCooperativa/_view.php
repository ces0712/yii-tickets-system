<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('estatus')); ?>:
	<?php echo GxHtml::encode($data->estatus); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tipo')); ?>:
	<?php echo GxHtml::encode($data->tipo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:
	<?php echo GxHtml::encode($data->fecha_creacion); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_responsable_cooperativa')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idResponsableCooperativa)); ?>
	<br />

</div>