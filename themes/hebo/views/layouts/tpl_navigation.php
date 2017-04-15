<section id="navigation-main">  
<div class="navbar">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
  
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
                    'items'=>array(
			/*			array('label'=>'Home <span class="caret"></span>', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"our home page"), 
                        'items'=>array(
                            array('label'=>'Home 1 - Nivoslider', 'url'=>array('/site/index')),
							array('label'=>'Home 2 - Bootstrap carousal', 'url'=>array('/site/page', 'view'=>'home2')),
							array('label'=>'Home 3 - Piecemaker2', 'url'=>array('/site/page', 'view'=>'home3')),
							array('label'=>'Home 4 - Static image', 'url'=>array('/site/page', 'view'=>'home4')),
							array('label'=>'Home 5 - Video header', 'url'=>array('/site/page', 'view'=>'home5')),
							array('label'=>'Home 6 - Without slider', 'url'=>array('/site/page', 'view'=>'home6')),
                        )),
						array('label'=>'Styles <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"6 styles"), 
                        'items'=>array(
                            array('label'=>'<span class="style" style="background-color:#0088CC;"></span> Style 1', 'url'=>"javascript:chooseStyle('none', 60)"),
							array('label'=>'<span class="style" style="background-color:#e42e5d;"></span> Style 2', 'url'=>"javascript:chooseStyle('style2', 60)"),
							array('label'=>'<span class="style" style="background-color:#c80681;"></span> Style 3', 'url'=>"javascript:chooseStyle('style3', 60)"),
							array('label'=>'<span class="style" style="background-color:#51a351;"></span> Style 4', 'url'=>"javascript:chooseStyle('style4', 60)"),
							array('label'=>'<span class="style" style="background-color:#b88006;"></span> Style 5', 'url'=>"javascript:chooseStyle('style5', 60)"),
							array('label'=>'<span class="style" style="background-color:#f9630f;"></span> Style 6', 'url'=>"javascript:chooseStyle('style6', 60)"),
                        )),
						array('label'=>'Features <span class="caret"></span>', 'url'=>array('/site/page', 'view'=>'columns'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"cool features"), 
                        'items'=>array(
                            array('label'=>'Columns', 'url'=>array('/site/page', 'view'=>'columns')),
							array('label'=>'Pricing tables', 'url'=>array('/site/page', 'view'=>'pricing-tables')),
							array('label'=>'UI Elements', 'url'=>array('/site/page', 'view'=>'elements')),
                        )),
                        */
                        array('label'=>'Tickets <span class="caret"></span>', 'url'=>array('/site/index', 'view'=>'columns'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"Gestionar Tickets de Jornada"), 
                        'items'=>array(
                         array('label'=>'Gestionar Tickets', 'url'=>array('/tickets/admin')),
                         array('label'=>'Procesar Ticket', 'url'=>array('/tickets/listado')),
                         
                        )),

                        array('label'=>'Voceros <span class="caret"></span>', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"Gestionar acciones de voceros"), 
                        'items'=>array(
                            array('label'=>'Creacion de Voceros', 'url'=>array('/vocero/create')),
                            array('label'=>'Administracion de Voceros', 'url'=>array('/vocero/admin')),
                            array('label'=>'Gestionar Tickets por Vocero', 'url'=>array('/tickets/adminTicketsVocero')),
                            array('label'=>'Crear Transferencia Vocero', 'url'=>array('/transferenciaVocero/asignarVoceroPiso')),
                            array('label'=>'Gestionar Transferencia Vocero', 'url'=>array('/transferenciaVocero/admin')),
                            array('label'=>'Carga Masiva de Vocero', 'url'=>array('/batchVocero/upload')),
                            array('label'=>'Gestionar Carga Masiva de Vocero', 'url'=>array('/batchVocero/admin')),
                        )),

                        array('label'=>'Cooperativas <span class="caret"></span>', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"Gestionar acciones de cooperativas"), 
                        'items'=>array(
                            array('label'=>'Creacion de Responsable', 'url'=>array('/responsableCooperativa/create')),
                            array('label'=>'Administracion Responsables', 'url'=>array('/responsableCooperativa/admin')),
                            array('label'=>'Creacion de Cooperativa', 'url'=>array('/tipoCooperativa/create')),
                            array('label'=>'Administracion de Cooperativa', 'url'=>array('/tipoCooperativa/admin')),
                            array('label'=>'Creacion de Cooperativista', 'url'=>array('/cooperativista/create')),
                            array('label'=>'Administracion de Cooperativista', 'url'=>array('/cooperativista/admin')),
                            array('label'=>'Generar Transferencia de Cooperativistas', 'url'=>array('/cooperativista/generarTransferencia')),
                            array('label'=>'Consultar Transferencia de Cooperativistas', 'url'=>array('/transferenciaCooperativa/admin')),
                        )),


                        array('label'=>'Jornada <span class="caret"></span>', 'url'=>array('/site/index', 'view'=>'columns'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"Gestionar acciones de Jornada"), 
                        'items'=>array(
                         array('label'=>'Crear Rubros', 'url'=>array('/rubros/create')),
                         array('label'=>'Gestionar Rubros', 'url'=>array('/rubros/admin')),
                         array('label'=>'Creacion de Jornada', 'url'=>array('/jornada/create')),
                         array('label'=>'Gestionar Jornada', 'url'=>array('/jornada/admin')),

                        )),

                        array('label'=>'Mantenimiento <span class="caret"></span>', 'url'=>array('/site/index', 'view'=>'columns'),'itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown","data-description"=>"Gestionar tablas maestro del sistema"), 
                        'items'=>array(
                         array('label'=>'Creacion Depositante', 'url'=>array('/depositante/create')),
                         array('label'=>'Gestionar Depositante', 'url'=>array('/depositante/admin')),
                         array('label'=>'Gestionar Bancos', 'url'=>array('/bancos/admin')),
                         array('label'=>'Creacion de Piso', 'url'=>array('/piso/create')),
                         array('label'=>'Gestionar Piso', 'url'=>array('/piso/admin')),
                         array('label'=>'Creacion de Edificio', 'url'=>array('/edificio/create')),
                         array('label'=>'Gestionar Edificio', 'url'=>array('/edificio/admin')),
                         array('label'=>'Creacion de Sede', 'url'=>array('/sede/create')),
                         array('label'=>'Gestionar Sede', 'url'=>array('/sede/admin')),
                         array('label'=>'Creacion de Tipo Vocero', 'url'=>array('/tipoVocero/create')),
                         array('label'=>'Gestionar Tipo Vocero', 'url'=>array('/tipoVocero/admin')),
                         array('label'=>'Gestionar Bloqueos', 'url'=>array('/bloqueos/admin')),
                         array('label'=>'Activar Mantenimiento de Sitio', 'url'=>array('/mantenimiento/admin')),
                         array('label'=>'Reporteador', 'url'=>array('/mantenimiento/reportico')),

                        )),

                        array('label'=>'Reportes', 'url'=>array('/mantenimiento/reportico'),'linkOptions'=>array("data-description"=>"Acceso al Area de Reportes"),),



                        // array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about'),'linkOptions'=>array("data-description"=>"what we are about"),),
                       
                        // array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"member area")),
                        // array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest,'linkOptions'=>array("data-description"=>"member area")),
                    ),
                )); ?>
    	</div>
    </div>
	</div>
</div>
</section><!-- /#navigation-main -->
