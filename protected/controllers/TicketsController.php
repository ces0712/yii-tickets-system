<?php

class TicketsController extends GxController {

	protected function cargarHistoricoRubros($model){
		$modelHistoricoRubro = new Historicorubros;
		$modelHistoricoRubro->cedula = $model->cedula;
		$modelHistoricoRubro->estatus = $model->estatus;
		$modelHistoricoRubro->estado_flujo = $model->estado_flujo;
		$modelHistoricoRubro->id_jornada = $model->id_jornada;
		$modelHistoricoRubro->tiempo = date('Y-m-d H:i:s');
		$modelHistoricoRubro->save();
	}	
	
	protected function gridDataRubros($data,$row) {
		if ($data->rubros == '') {
			return 'No Asignado';
		}
		 $checkRubros = explode(',', $data->rubros);
		 $nombre_rubro = '';
		 foreach ($checkRubros as $r) {
		 	$r = (int)$r;
		 	if ($nombre_rubro == '') {
		 		$nombre_rubro = Rubros::model()->findByAttributes(array('id'=>$r));
		 	}else
		    	$nombre_rubro = $nombre_rubro.', '.Rubros::model()->findByAttributes(array('id'=>$r));
		 }
		 return $nombre_rubro;
        }
	
	protected function gridDataJornada($data, $row) {
		$model_jornada = Jornada::model()->findByAttributes(array('id'=>$data->id_jornada));
		return $model_jornada->nombre;
	}

	protected function filterGridDataJornada() {
		$data = array();
		$condicion = 'estatus = true';
		$models = Jornada::model()->findAll($condition=$condicion);
		foreach ($models as $model_jornada)
    			$data[$model_jornada->id] = $model_jornada->nombre;  
		return $data;
	}

	protected function gridDataBanco($data, $row) {
		$model_banco = Bancos::model()->findByAttributes(array('id'=>$data->id_banco));
		return $model_banco->nombre;
	}

	protected function filterGridDataBanco() {
		$data = array();
		$condicion = 'estatus = true';
		$models = Bancos::model()->findAll($condition=$condicion);
		foreach ($models as $model_banco)
    			$data[$model_banco->id] = $model_banco->nombre;  
		return $data;
	}

	protected function gridDataVoceros($data, $row) {
		$model_vocero = Vocero::model()->findByAttributes(array('id'=>$data->id_vocero));
		return $model_vocero->nombres . ' ' . $model_vocero->apellidos;
	}

	protected function filterGridDataVoceros() {
		$data = array();
		$models = Vocero::model()->findAll();
		foreach ($models as $model_vocero)
    			$data[$model_vocero->id] = $model_vocero->nombres . ' '. $model_vocero->apellidos;  
		return $data;
	}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Tickets'),
		));
	}


	public function actionProcesar() {
		
		if (isset($_GET['Tickets'])) {
			$id_jornada = $_GET['Tickets']['id_jornada'];
			$q = new CDbCriteria( array(
		    'condition' => "id_jornada =:match and estado_flujo in (2,3) order by atencion_preferencial DESC,id ASC",         // no quotes around :match estado de flujo es distinto de creado, finalizado, bloqueado, Por verificar por vocero
		    'params'    => array(':match' => $id_jornada)  // Aha! Wildcards go here
			) );		
			$registro = Tickets::model()->find($q);
			$model = $this->loadModel($registro['id'], 'Tickets');
			$model->estado_flujo = 4; // modifico a finalizado
			$model->hora_finalizacion = date('Y-m-d H:i:s'); 		
			if ($model->save()) {
				// Guardar en Historico Rubro
				$this->cargarHistoricoRubros($model);
			}
			$this->redirect(array('listado', 'id_jornada' => $_GET['Tickets']['id_jornada']));
		}

			$this->redirect(array('listado'));
	}

	public function actionCreate() {
		$model = new Tickets;

		$this->performAjaxValidation($model, 'tickets-form');

		if (isset($_POST['Tickets'])) {
			$model->setAttributes($_POST['Tickets']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}
	
	public function actionUpdateTicketsVocero($id) {
		$model = $this->loadModel($id, 'Tickets');

		$this->performAjaxValidation($model, 'tickets-form');
		if (isset($_POST['Tickets'])) {
			$model->setAttributes($_POST['Tickets']);
			// $model->estado_flujo =  1;
			$model->estado_flujo =  11;
			$model->numero_cedula = $model->cedula.'-'.$id;


			if ($model->save()) {

				// Guardar en Historico Rubro
				$this->cargarHistoricoRubros($model);

				// Calculo de Hora tentativa del siguiente en turno
				
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('updateTicketsVocero', array(
				'model' => $model,
				));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Tickets');

		$this->performAjaxValidation($model, 'tickets-form');

		if (isset($_POST['Tickets'])) {
			$model->setAttributes($_POST['Tickets']);
			$model->estatus = 'true'; // La Persona asistio a la Jornada
			$horaActual = date('Y-m-d H:i:s');
			$model->hora_asistencia = $horaActual;
			$model->estado_flujo = 2; // Estado de flujo Asignado rubro
			if((boolean)$model->atencion_preferencial === true) {
				$model->numero_cedula = $model->numero_cedula.'-atencion preferencial';
			}
			
			if ($model->hora_asistencia_tentativa != '') {
				$start_date = new DateTime($model->hora_asistencia_tentativa);
				$since_start = $start_date->diff(new DateTime($horaActual));
				$tiempoBloqueo = Bloqueos::model()->findByPk(1);
				if (((int)$since_start->i > (int)$tiempoBloqueo->tiempo) && $tiempoBloqueo->estatus == 'true') {
					$model->estado_flujo = 5; // Estado de flujo Bloqueado automatico rubro
				}
			}else
				$model->hora_asistencia_tentativa = $horaActual;
			
			
			if ($model->save()) {

				// Guardar en Historico Rubro
				$this->cargarHistoricoRubros($model);

				// Calculo de Hora tentativa del siguiente en turno
			
				$contar = Tickets::model()->countByAttributes(array(
	            		'estatus'=> 'true', 'id_jornada'=>$model->id_jornada
	        		));
	        		if ($contar > 1 && (boolean)$model->atencion_preferencial === false) {
					$q = new CDbCriteria( array(
		    			'condition' => "id_jornada =:match and estado_flujo = 1 order by id ASC",  // no quotes around :match estado de flujo es distinto de creado
		    			'params'    => array(':match' => $model->id_jornada)  // Aha! Wildcards go here
					) );		
					
					$registro = Tickets::model()->find($q);
						
	        			Tickets::model()->updateByPk($registro->id,array('hora_asistencia_tentativa'=>$horaActual));
	        			// Bloqueos::model()->updateByPk(1,array('horaInicio'=>$horaActual));
	        		
	        		} 
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			//if (isset($_GET['Tickets'])) {
				$model = $this->loadModel($id, 'Tickets');
				$model->retener_rubro = 'true';
				//$model->rubro_id = $_GET['Tickets']['rubros'];
				$model->save();
		    //}

			// $this->loadModel($id, 'Tickets')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('listado'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAvanzarTicketsVocero($id) {

		if (isset($_GET['id'])) {
			$model = $this->loadModel($id, 'Tickets');
			$model->numero_cedula = $model->cedula.'-'.$id;
		        // $model->estado_flujo = 1;
			$model->estado_flujo = 11;
			$model->save();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('adminTicketsVocero', 'id_vocero'=>$model->id_vocero, 'id_jornada'=>$model->id_jornada));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}
	
	public function actionReversarTicketsVocero($id) {

		if (isset($_GET['id'])) {
			$model = $this->loadModel($id, 'Tickets');
			$model->numero_cedula = '';
			$model->estado_flujo = 6;
			$model->save();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('adminTicketsVocero'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));

	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Tickets');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		if(Yii::app()->params['maintenance'] == true) {
			//$this->renderPartial('mantenimiento');
			//exit();
			throw new CHttpException(404, 'Sitio en Mantenimiento');
		}
		$model = new Tickets('search');
		$model->unsetAttributes();

		if (isset($_GET['Tickets']))
			$model->setAttributes($_GET['Tickets']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
	
	public function actionAdminTicketsVocero() {
                if(Yii::app()->params['maintenance'] == true) {
                        //$this->renderPartial('mantenimiento');
                        //exit();
                        throw new CHttpException(404, 'Sitio en Mantenimiento');
                }
                $model = new Tickets('search_por_tickets_vocero');
                $model->unsetAttributes();

                if (isset($_GET['Tickets']))
                        $model->setAttributes($_GET['Tickets']);

                $this->render('adminTicketsVocero', array(
                        'model' => $model,
                ));
        }

	public function actionAdminConsolidadoTicketsVocero() {
                if(Yii::app()->params['maintenance'] == true) {
                        //$this->renderPartial('mantenimiento');
                        //exit();
                        throw new CHttpException(404, 'Sitio en Mantenimiento');
                }
                $model = new Tickets('search');
                $model->unsetAttributes();

                if (isset($_GET['Tickets']))
                        $model->setAttributes($_GET['Tickets']);

                $this->render('adminConsolidadoTicketsVocero', array(
                        'model' => $model,
                ));
        }



	public function actionListado() {
		$model = new Tickets('search');
		$model->unsetAttributes();

		if (isset($_GET['Tickets']))
			$model->setAttributes($_GET['Tickets']);

		$this->render('listado', array(
			'model' => $model,
		));
	}

}
