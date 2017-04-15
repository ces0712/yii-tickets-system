<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Cooperativistas';
$this->breadcrumbs=array(
	'Cooperativistas',
);
?>

<h1>Listado de Cooperativistas</h1>




<p>
En caso de registrarse su cita correspondera a la siguiente semana: 
</p>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'cooperativistas-grid',
        'dataProvider' => Cooperativistas::model()->search(),
        'filter' => Cooperativistas::model(),
        'columns' => array(
                'cedula',
                'apellido1',
                'nombre1',
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

