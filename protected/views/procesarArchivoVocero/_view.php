<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('estatus')); ?>:
	<?php echo GxHtml::encode($data->estatus); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nombre')); ?>:
	<?php echo GxHtml::encode($data->nombre); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_estado')); ?>:
	<?php echo GxHtml::encode($data->id_estado); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_jornada')); ?>:
	<?php echo GxHtml::encode($data->id_jornada); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_depositante')); ?>:
	<?php echo GxHtml::encode($data->id_depositante); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:
	<?php echo GxHtml::encode($data->fecha_creacion); ?>
	<br />

</div>