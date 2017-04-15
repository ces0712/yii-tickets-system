<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('estatus')); ?>:
	<?php echo GxHtml::encode($data->estatus); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('rubros')); ?>:
	<?php echo GxHtml::encode($data->rubros); ?>
	<br />

</div>