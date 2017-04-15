<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Empleados';
$this->breadcrumbs=array(
	'Empleados',
);
?>

<h1>Listado de Empleados</h1>




<p>
En caso de registrarse su cita correspondera a la siguiente semana: 
</p>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'empleados-grid',
        'dataProvider' => Empleados::model()->search(),
        'filter' => Empleados::model(),
        'columns' => array(
                'cedula',
                'apellidos',
                'nombres',
                'num_semana',
                /*array(
                                'name'=>'id_banco',
                                'value'=>'GxHtml::valueEx($data->idBanco)',
                                'filter'=>GxHtml::listDataEx(Bancos::model()->findAllAttributes(null, true)),
                                ),
                
                array(
                                        'name' => 'estatus',
                                        'value' => '($data->estatus === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
                                        'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
                                        ),
                array(
                                'name'=>'id_modo_pago',
                                'value'=>'GxHtml::valueEx($data->idModoPago)',
                                'filter'=>GxHtml::listDataEx(Modopago::model()->findAllAttributes(null, true)),
                                ),
          'monto',
                */
               /* array(
                        'class' => 'CButtonColumn',
                        'template'=>'{update}',
                ),*/
        ),
));


?> 

