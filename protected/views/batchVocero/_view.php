<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('estatus')); ?>:
	<?php echo GxHtml::encode($data->estatus); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_referencia')); ?>:
	<?php echo GxHtml::encode($data->fecha_referencia); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('referencia')); ?>:
	<?php echo GxHtml::encode($data->referencia); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('descripcion')); ?>:
	<?php echo GxHtml::encode($data->descripcion); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('saldo')); ?>:
	<?php echo GxHtml::encode($data->saldo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('debito')); ?>:
	<?php echo GxHtml::encode($data->debito); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('credito')); ?>:
	<?php echo GxHtml::encode($data->credito); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('tipo')); ?>:
	<?php echo GxHtml::encode($data->tipo); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('fecha_creacion')); ?>:
	<?php echo GxHtml::encode($data->fecha_creacion); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_procesar_archivo_vocero')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idProcesarArchivoVocero)); ?>
	<br />
	*/ ?>

</div>