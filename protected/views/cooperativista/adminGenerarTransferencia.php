<?php

$this->breadcrumbs = array(
  $model->label(2) => array('index'),
  Yii::t('app', 'Generar Transferencia'),
);

$this->menu = array(
    array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
    array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
  );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
  $('.search-form').toggle();
  return false;
});
$('.search-form form').submit(function(){
  $.fn.yiiGridView.update('cooperativista-grid', {
    data: $(this).serialize()
  });
  return false;
});
");
?>
<div class="row-fluid">
<h1><?php echo Yii::t('app', 'Gestionar Transferencia') . ' ' . GxHtml::encode($model->label(2)); ?></h1>
<?php 
if (count($model->message) > 0) {
  foreach ($model->message as $key => $value) {
      if ($key === 'warning') {
        echo '<div class="alert">'.$value."</div>\n";
      } else
        echo '<div class="alert alert-'.$key.'">'.$value."</div>\n";
  }
}
?>

<?php $form = $this->beginWidget('GxActiveForm', array(
  'id' => 'generar-transferencia-cooperativa-form',
  'enableAjaxValidation' => true,
));
?>
<div class="row-fluid">
  <div class="span6">
    <?php echo $form->labelEx($model,'id_jornada'); ?>
    <?php echo $form->dropDownList($model, 'id_jornada', $this->filterGridDataJornada(),array('prompt' => 'Seleccione Jornada')); ?>
    <?php echo $form->error($model,'id_jornada'); ?>
  </div><!-- row -->
  <div class="span6">
    <?php  echo $form->labelEx($model,'id_vocero'); ?>
    <?php
    echo $form->dropDownList($model, 'id_vocero', $this->getVocero(),array('prompt' => 'Seleccione un vocero')); ?>
    <?php echo $form->error($model,'id_vocero'); ?>
  </div><!-- row -->
</div><!-- row-fluid -->


<div class="row-fluid">
  <div class="span6">
    <?php echo $form->labelEx($model,'id_depositante'); ?>
    <?php // echo $form->dropDownList($model, 'id_depositante', GxHtml::listDataEx(Depositante::model()->findAllAttributes(null, true)),array('prompt' => 'Seleccione Titular' )); 
    $this->widget('zii.widgets.jui.CJuiAutoComplete',
      array(
      // 'name'=>'depositante',
      'model'=>$model,
      'attribute'=>'nombres_apellidos_depositante',
      'source'=>Yii::app()->createUrl('transferenciaVocero/autocompleteDepositante'),
       
      'options'=>array(
      'showAnim'=>'fold',
      'search' => 'js:function(event, ui){
                        $(\'#Cooperativista_id_depositante\').val();
                       }',
                        'select' => 'js:function(event, ui){
                            var res = ui.item.value.split("-");
                            $(\'#Cooperativista_id_depositante\').val(res[0]);
                        }',
                    
      ),
       
      'htmlOptions'=>array(
      'style'=>'width: 206px',
      ),
    ));

    ?>
    <?php echo $form->hiddenField($model,'id_depositante'); ?>
    <?php echo $form->error($model,'id_depositante'); ?>
  </div><!-- row -->
  <div class="span6">
        <?php echo $form->labelEx($model,'id_banco'); ?>
    <?php echo $form->dropDownList($model, 'id_banco', $this->filterGridDataBanco(), array('prompt' => 'Seleccione Entidad Bancaria' )); ?>
    <?php echo $form->error($model,'id_banco'); ?>
  </div><!-- row -->
</div><!-- row-fluid -->


<div class="row-fluid">
  <div class="span6">
      <?php echo $form->labelEx($model,'referencia_bancaria'); ?>
      <?php echo $form->textField($model, 'referencia_bancaria', array('maxlength' => 100)); ?>
      <?php echo $form->error($model,'referencia_bancaria'); ?>
  </div><!-- row -->
  <div class="span6">
    <?php echo $form->labelEx($model,'monto_transferido'); ?>
    <?php echo $form->textField($model, 'monto_transferido'); ?>
    <?php echo $form->error($model,'monto_transferido'); ?>
  </div><!-- row -->
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
  'id' => 'cooperativista-grid',
  'dataProvider' => $model->search_generar_transferencia(),
  'enablePagination'=>false,
  'selectableRows' => 2,
  'filter' => $model,
  'columns' => array(
    array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
    'id',
  array(
          'name' => 'estatus',
          'value' => '($data->estatus === false) ? Yii::t(\'app\', \'Inactivo\') : Yii::t(\'app\', \'Activo\')',
          'filter' => array('0' => Yii::t('app', 'Inactivo'), '1' => Yii::t('app', 'Activo')),
          ),
    'nombres_apellidos',
    'cedula',
    array(
        'name'=>'id_tipo_cooperativa',
        'value'=>'GxHtml::valueEx($data->idTipoCooperativa)',
        'filter'=>GxHtml::listDataEx(TipoCooperativa::model()->findAllAttributes(null, true)),
        ),
    // 'fecha_creacion',
    /*array(
      'class' => 'CButtonColumn',
      'template'=>'{update}',
    ),*/
  ),
)); ?>

<div>
<?php echo GxHtml::submitButton(Yii::t('app', 'Guardar'),array('class' => 'btn btn-primary'));?>
<?php // echo CHtml::submitButton('Approve', array('name' => 'ApproveButton')); ?>
<?php /* echo CHtml::submitButton('Delete', 
array('name' => 'DeleteButton',
'confirm' => 'Are you sure you want to permanently delete these comments?')); */
?>
</div>

<?php $this->endWidget();?>
</div>
<!-- http://stackoverflow.com/questions/12923415/how-to-process-selected-rows-in-yii-cgridview -->