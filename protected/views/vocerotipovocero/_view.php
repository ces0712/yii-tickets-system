<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id_vocero')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idVocero)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('id_tipo_vocero')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->idTipoVocero)); ?>
	<br />

</div>