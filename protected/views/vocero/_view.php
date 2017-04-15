<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('estatus')); ?>:
	<?php echo GxHtml::encode($data->estatus); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('nombres')); ?>:
	<?php echo GxHtml::encode($data->nombres); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('apellidos')); ?>:
	<?php echo GxHtml::encode($data->apellidos); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cedula')); ?>:
	<?php echo GxHtml::encode($data->cedula); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:
	<?php echo GxHtml::encode($data->fecha_creacion); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_sede')); ?>:
	<?php echo GxHtml::encode(GxHtml::valueEx($data->idSede)); ?>
	<br />
	<?php 
	<?php echo GxHtml::encode($data->getAttributeLabel('id_edificio')); ?>:
	<?php echo GxHtml::encode(GxHtml::valueEx($data->idEdificio)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_piso')); ?>:
	<?php echo GxHtml::encode(GxHtml::valueEx($data->idPiso)); ?>
	<br />

</div>
