<?php

class TransferenciaVoceroController extends GxController {

  public function actionAutocompleteDepositante(){
    $fieldValue = array();
    if (isset($_GET['term'])) {
      $match = addcslashes($_GET['term'], '%_');
      $c = 'nombres_apellidos ILIKE :match';
      $p = array(':match' => "%$match%");
      $encontrarDepositante = Depositante::model()->findAll($condition = $c, $params = $p);
      foreach ($encontrarDepositante as $modelDepositante) {
        $fieldValue[$modelDepositante->id] = $modelDepositante->getAttribute('id').'-'. $modelDepositante->getAttribute('nombres_apellidos');
      }
    }
    echo json_encode($fieldValue);
    Yii::app()->end();
  }

	protected function actualizarVoceroTickets($model) {
		$set = array('estado_flujo' =>$model->id_estado);
		$condicion = 'id_jornada =:id_jornada and estado_flujo =:estado_flujo ';
    $p = array(':id_jornada' => $model->id_jornada);

		if ($model->id_estado === 7) { // piso
			$set['id_vocero_piso'] = $model->id_vocero_receptor;
			$condicion .= 'and id_vocero =:id_vocero_emisor ';
      $p[':id_vocero_emisor'] = $model->id_vocero_emisor;
			$estado_anterior = 11;

		}else if ($model->id_estado === 8) { // edificio
			$set['id_vocero_edificio'] = $model->id_vocero_receptor;
			$condicion .= 'and id_vocero_piso =:id_vocero_emisor ';
      $p[':id_vocero_emisor'] = $model->id_vocero_emisor;
			$estado_anterior = 7;
			
		}else if ($model->id_estado === 9) { // sede 
			$set['id_vocero_sede'] = $model->id_vocero_receptor;
			$condicion .= 'and id_vocero_edificio =:id_vocero_emisor ';
      $p[':id_vocero_emisor'] = $model->id_vocero_emisor;	
			$estado_anterior = 8;
		}else if ($model->id_estado === 10) { // Pendiente por crear ticket
      $condicion .= 'and id_vocero_sede =:id_vocero_receptor ';
      $p[':id_vocero_receptor'] = $model->id_vocero_receptor; 
      $estado_anterior = 9;
    }
		
    $p[':estado_flujo'] = $estado_anterior;
		
		 Tickets::model()->updateAll($set,
                                $condition = $condicion,
                                $params = $p
    );

	}

	public function actionSetMontoFromVoceroReceptor() {
		$estado_flujo = 11;
		$fieldValue = array();
		if(isset($_POST['id_vocero_emisor']) && isset($_POST['id_jornada'])) {
      $id_jornada = $_POST['id_jornada'];
      $id_vocero_emisor = $_POST['id_vocero_emisor'];
      $q = new CDbCriteria();
      $q->select = 'sum(monto) as monto_acumulado';
      $q->condition = 't.estado_flujo=:estado_flujo and t.id_jornada =:id_jornada and t.id_vocero =:id_vocero';
      $q->params = array(':estado_flujo' => $estado_flujo, ':id_jornada' => $id_jornada, ':id_vocero' => $id_vocero_emisor);
      $monto = Tickets::model()->find($q);
      $fieldValue['monto_acumulado'] = $monto->getAttribute('monto_acumulado');
    } // fin de if isset
		echo json_encode($fieldValue);

	}

	public function actionSetFromJornada(){
		$estado_flujo = 11;
		$fieldValue = array();
		if(isset($_POST['id_jornada'])) {
			$id_jornada = $_POST['id_jornada'];
      $q2 = new CDbCriteria();
      $q2->select = "distinct t.id_vocero as id_vocero, concat(v.nombres, ' ',v.apellidos) as voceros";
      $q2->join = 'INNER JOIN vocero as v ON t.id_vocero = v.id'; 
      $q2->condition = 't.estado_flujo=:estado_flujo and t.id_jornada =:id_jornada';
      $q2->params = array(':estado_flujo' => $estado_flujo, ':id_jornada' => $id_jornada);
      $voceros_emisores = Tickets::model()->findAll($q2);
			foreach($voceros_emisores as $voceros) {
				 $fieldValue[$voceros->id_vocero] =  $voceros->getAttribute('voceros');
			}

		} // fin isset $_POST['id_jornada']
		
		echo json_encode($fieldValue);
		
	}

	public function actionSetFromVoceroEmisor() {
		// En los voceros emisores realmente almacene los valores pk de historicoTransferencia para permitir varias transferencias con el mismo nombre
    $fieldValue = array();
		$data = HistoricoTransferenciaVocero::model()->find(
    $condition  = 'id_estado =:id_estado and id = :id_vocero_emisor and id_jornada =:id_jornada and id_vocero_receptor =:id_vocero_receptor',
    $params     = array(
    ':id_vocero_emisor' => $_POST['id_vocero_emisor'],
    ':id_vocero_receptor' => $_POST['id_vocero_receptor'],
    ':id_jornada' => $_POST['id_jornada'],
    ':id_estado' => $_POST['id_estado'],

    ));

	  $fieldValue['referencia_bancaria'] = $data->getAttribute('referencia_bancaria');
    $fieldValue['id_banco'] = $data->getAttribute('id_banco');
    $fieldValue['id_depositante'] = $data->getAttribute('id_depositante');
	  $fieldValue['monto_transferido'] = $data->getAttribute('monto_transferido');

		echo json_encode($fieldValue);
	}
	protected function validarTransferenciaExistente($model,$operacion) {
		$id = $model->id;
		$encontrarTransferenciaVocero = TransferenciaVocero::model()->find(
      $condition  = 'id_vocero_receptor = :id_vocero_receptor and id_jornada =:id_jornada and id_estado =:id_estado',
      $params     = array(
      ':id_vocero_receptor' => $model->id_vocero_receptor,
      ':id_jornada' => $model->id_jornada,
      ':id_estado' => $model->id_estado,
    ));
			
    if(count($encontrarTransferenciaVocero) > 0) {
      $modelActualizar = $this->loadModel($encontrarTransferenciaVocero->id, 'TransferenciaVocero');
		  $modelActualizar->setAttributes($_POST['TransferenciaVocero']);
      $modelActualizar->monto_transferido = $encontrarTransferenciaVocero->monto_transferido + $model->monto_transferido;
      if ($modelActualizar->save()) {
        $modelHistorico = $this->cargarHistorico($modelActualizar);
				$modelHistorico->monto_transferido = $model->monto_transferido;
        $modelHistorico->save();
        $this->actualizarVoceroTickets($model);
				if($operacion === 'avanzar') {
					$this->loadModel($id, 'TransferenciaVocero')->delete();
				}
        $this->redirect(array('view', 'id' => $modelActualizar->id));
      }
    }

		return $encontrarTransferenciaVocero;		

	}

	protected function cargarHistorico($model) {
		$modelHistorico = new HistoricoTransferenciaVocero;
		$modelHistorico->id_vocero_emisor = $model->id_vocero_emisor;
		$modelHistorico->id_vocero_receptor = $model->id_vocero_receptor;
		$modelHistorico->referencia_bancaria = $model->referencia_bancaria;
		$modelHistorico->id_banco = $model->id_banco;
		$modelHistorico->id_estado = $model->id_estado;
		$modelHistorico->fecha_creacion = $model->fecha_creacion;
		$modelHistorico->id_jornada = $model->id_jornada;
		$modelHistorico->monto_transferido = $model->monto_transferido;
		$modelHistorico->id_transferencia_vocero = $model->id;
    $modelHistorico->id_depositante = $model->id_depositante;
		// $modelHistorico->save();
		return $modelHistorico;
	
	}
	protected function buscarVocero($tipo_vocero) {
    $data = array();
		$encontrarVoceroPorTipo = Vocerotipovocero::model()->findAll(
      $condition  = 'id_tipo_vocero = :someVarName',
      $params     = array(
      ':someVarName' => $tipo_vocero,
    ));
    foreach ($encontrarVoceroPorTipo as $model_vocero_tipo) {
      $model = Vocero::model()->find(
      $condition  = 'id = :someVarName',
      $params     = array(
      ':someVarName' => $model_vocero_tipo->id_vocero,
      ));
      $data[$model->id] = $model->nombres.' '.$model->apellidos;
    }
		return $data;
	}
	
	 protected function getMontoTransferido($model,$form) {
		$modulo = explode('/',$_GET['r']);
		if($modulo[1] === 'avanzarTransferenciaVocero' || $modulo[1] === 'asignarVoceroPiso') {
		     echo $form->textField($model, 'monto_transferido',array('readonly'=>true));
		}else {
		     echo $form->textField($model, 'monto_transferido');			
		}		
	 }

	 protected function getVocero($tipo,$model) {

		// id_estado = 7 Asignado a Piso
		// id_estado = 8 Asignado a Edificio
		// id_estado = 9 Asignado a Sede
		// id_estado = 10 Pendiente por generar ticket

		// tipo Vocero
		// id_tipo_vocero = 1 Sede
		// id_tipo_vocero = 2 Edificio
		// id_tipo_vocero = 3 Piso
		// german id_vocero 2 // laura id_vocero 1
		

    $data = array();
		$modulo = explode('/',$_GET['r']);
		
		if($model->id_estado == '') {
			$tipo_vocero_receptor = 3; // Tipo vocero piso
			
		}else if ($modulo[1] === 'update') {
			if ($model->id_estado === 7) $tipo_vocero_receptor = 3;
			else if ($model->id_estado === 8) {
				$tipo_vocero_receptor = 2;
				$tipo_vocero_emisor = 3; 
			}
			else if ($model->id_estado === 9) { 
				$tipo_vocero_receptor = 1;
				$tipo_vocero_emisor = 2;
			}
		}else if($modulo[1] === 'avanzarTransferenciaVocero') {
			if ($model->id_estado === 7) {
				$tipo_vocero_receptor = 2;
				$tipo_vocero_emisor = 3;
			}else if($model->id_estado === 8 || $model->id_estado === 9) {
				$tipo_vocero_receptor = 1;
				$tipo_vocero_emisor = 2;
			}
		} 	
    if($tipo ==='e') {
			if($modulo[1] === 'update') {
				$encontrarVoceroEmisor = HistoricoTransferenciaVocero::model()->findAll(
        $condition  = 'id_transferencia_vocero = :id_transferencia_vocero and id_vocero_receptor =:id_vocero_receptor and id_estado =:id_estado',
        $params     = array(
        ':id_transferencia_vocero' => $model->id,
        ':id_vocero_receptor' => $model->id_vocero_receptor,
        ':id_estado' => $model->id_estado,
			
        ));
				foreach ($encontrarVoceroEmisor as $model_vocero_emisor) {
					// Error Logico si tengo 2 o mas transferencias en esas condiciones de la misma persona toma una se corrigio asignando el pk de la tabla
          // $data[$model_emisor->id] = $model_emisor->nombres.' '.$model_emisor->apellidos;
          $model_emisor = Vocero::model()->findByPk($model_vocero_emisor->id_vocero_emisor);
          $data[$model_vocero_emisor->id] = $model_emisor->nombres.' '.$model_emisor->apellidos;	
        }

			} else if($model->id_estado == '') {
				  $models = Vocero::model()->findAll();
          foreach ($models as $model_vocero)
            $data[$model_vocero->id] = $model_vocero->nombres . ' '. $model_vocero->apellidos;
			}else {
				$data = $this->buscarVocero($tipo_vocero_emisor);
			}

		} else if($tipo === 'r') {
			$data = $this->buscarVocero($tipo_vocero_receptor);
		}
	
    return $data;
  }

	protected function gridDataVocerosEmisor($data, $row) {
		$model_vocero = Vocero::model()->findByAttributes(array('id'=>$data->id_vocero_emisor));
		return $model_vocero->nombres . ' ' . $model_vocero->apellidos;
	}

	protected function gridDataVocerosReceptor($data, $row) {
		$model_vocero = Vocero::model()->findByAttributes(array('id'=>$data->id_vocero_receptor));
		return $model_vocero->nombres . ' ' . $model_vocero->apellidos;
	}

	protected function filterGridDataVoceros() {
		$data = array();
		$models = Vocero::model()->findAll();
		foreach ($models as $model_vocero)
    	$data[$model_vocero->id] = $model_vocero->nombres . ' '. $model_vocero->apellidos;  
		return $data;
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

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'TransferenciaVocero'),
		));
	}

	public function actionCreate() {
		$model = new TransferenciaVocero;

		$this->performAjaxValidation($model, 'transferencia-vocero-form');

		if (isset($_POST['TransferenciaVocero'])) {
			$model->setAttributes($_POST['TransferenciaVocero']);
			$model->fecha_creacion = date('Y-m-d H:i:s');
			$model->id_estado = 7; // Cambia a estado por Asignado Vocero por Piso
			
			$encontrarTransferenciaVocero = $this->validarTransferenciaExistente($model,'create'); 

                                        
      if(count($encontrarTransferenciaVocero) === 0) {
				if ($model->save()) {
          $modelHistorico = $this->cargarHistorico($model);
          $modelHistorico->save();
					if (Yii::app()->getRequest()->getIsAjaxRequest())
						Yii::app()->end();
					else
						$this->redirect(array('view', 'id' => $model->id));
				} // if fin model save
			} // if fin $encontrarTransferencia
		} // if fin isset POST
		
		$this->render('create', array( 'model' => $model));
	}

	public function actionAsignarVoceroPiso() {
    $model = new TransferenciaVocero;

    $this->performAjaxValidation($model, 'transferencia-vocero-form');

    if (isset($_POST['TransferenciaVocero'])) {
      $model->setAttributes($_POST['TransferenciaVocero']);
      $model->fecha_creacion = date('Y-m-d H:i:s');
      $model->id_estado = 7; // Cambia a estado por Asignado Vocero por Piso

      $encontrarTransferenciaVocero = $this->validarTransferenciaExistente($model,'create');


      if(count($encontrarTransferenciaVocero) === 0) {
        if ($model->save()) {
          $modelHistorico = $this->cargarHistorico($model);
          $modelHistorico->save();
					// Verificar si funciona
					$this->actualizarVoceroTickets($model);
          if (Yii::app()->getRequest()->getIsAjaxRequest())
            Yii::app()->end();
          else
            $this->redirect(array('view', 'id' => $model->id));
        } // if fin model save
      } // if fin $encontrarTransferencia
    } // if fin isset POST
    $this->render('asignarVoceroPiso', array( 'model' => $model));
  }


	public function actionUpdate($id) {
		
		$model = $this->loadModel($id, 'TransferenciaVocero');
		if($model->id_estado !== 10) {
			$model->monto_transferido = null;
			// $model->id_vocero_emisor = null;
      if (!isset($_POST['TransferenciaVocero'])) {
        $model->id_banco = null;
        $model->referencia_bancaria = null;
        $model->id_depositante = null;
      }
			$this->performAjaxValidation($model, 'transferencia-vocero-form');

			if (isset($_POST['TransferenciaVocero']['id_vocero_emisor'])) {
				// El id_vocero_emisor es realmente el id de la tabla historico transferencia
				$fecha = date('Y-m-d H:i:s');
				$id_historico = (int)$_POST['TransferenciaVocero']['id_vocero_emisor'];
				$modelHistoricoTransferencia = $this->loadModel($id_historico,'HistoricoTransferenciaVocero');
				$modelHistoricoTransferencia->id_banco = (int)$_POST['TransferenciaVocero']['id_banco'];
				$modelHistoricoTransferencia->referencia_bancaria = $_POST['TransferenciaVocero']['referencia_bancaria'];
				$modelHistoricoTransferencia->monto_transferido = (real)$_POST['TransferenciaVocero']['monto_transferido'];
        $modelHistoricoTransferencia->id_depositante = (int)$_POST['TransferenciaVocero']['id_depositante'];
				$modelHistoricoTransferencia->fecha_creacion = $fecha;

				if($modelHistoricoTransferencia->save()) {
          $model->id_depositante = (int)$_POST['TransferenciaVocero']['id_depositante'];
          $model->id_banco = (int)$_POST['TransferenciaVocero']['id_banco'];
          $model->referencia_bancaria = $_POST['TransferenciaVocero']['referencia_bancaria'];
					$model->fecha_creacion = $fecha;
				
					$sumarMontoTransferido = HistoricoTransferenciaVocero::model()->find(
					array(
					  'select' => 'sum(monto_transferido) as monto',
					  'condition'  => 'id_transferencia_vocero = :id_transferencia_vocero and id_vocero_receptor =:id_vocero_receptor and id_estado =:id_estado and id_jornada =:id_jornada',
            'params'     => array(
            ':id_transferencia_vocero' => $modelHistoricoTransferencia->id_transferencia_vocero,
            ':id_vocero_receptor' => $modelHistoricoTransferencia->id_vocero_receptor,
            ':id_estado' => $modelHistoricoTransferencia->id_estado,
            ':id_jornada' => $modelHistoricoTransferencia->id_jornada,
				
					)));
					
          $model->monto_transferido = $sumarMontoTransferido->monto;
					if ($model->save()) {
						$this->redirect(array('view', 'id' => $model->id));
					}
				}// fin if $modelHistoricoTransferencia->save()
			

			} // fin if isset($_POST['TransferenciaVocero']['id_vocero_emisor'])

			$this->render('update', array(
				'model' => $model,
	  		));
		} // fin if $model->id_estado
		else  $this->redirect(array('admin'));
	}



	 public function actionAvanzarTransferenciaVocero($id) {
    // Yii::log('ajax','info');
    $model = $this->loadModel($id, 'TransferenciaVocero');
    $modelPrevio = $model;
    if ($modelPrevio->id_estado === 10) {
         $this->redirect(array('admin'));
    }	else if($modelPrevio->id_estado === 9) {
			$model->id_estado = 10; // Pendiente por crear
			if ($model->save() && !Yii::app()->getRequest()->getIsAjaxRequest()) {
				$modelHistorico = $this->cargarHistorico($model);
        $modelHistorico->save();
        $this->actualizarVoceroTickets($model); 
        $this->redirect(array('admin'));
			}
		}else {
      
			$model->id_vocero_emisor = $model->id_vocero_receptor;
			$model->id_vocero_receptor = null;
			$model->id_banco = null;
			$model->referencia_bancaria = null;
      $model->id_depositante = null;


      $this->performAjaxValidation($model, 'transferencia-vocero-form');

      if (isset($_POST['TransferenciaVocero'])) {
        $model->setAttributes($_POST['TransferenciaVocero']);
        $model->fecha_creacion = date('Y-m-d H:i:s');
				if($modelPrevio->id_estado === 7) {
					$model->id_estado = 8; // Pasa Asignado por Edificio
				}else if($modelPrevio->id_estado === 8) {
					$model->id_estado = 9; // Pasa Asignado por Sede
				} 

				$encontrarTransferenciaVocero = $this->validarTransferenciaExistente($model,'avanzar');
				if(count($encontrarTransferenciaVocero) === 0) {
          // print_r($model);
          // die();
				  if ($model->save()) {
						$modelHistorico = $this->cargarHistorico($model);
						$modelHistorico->save();
						$this->actualizarVoceroTickets($model);
            $this->redirect(array('view', 'id' => $model->id));
          }
      	}
                        
	
      } // fin if isset($_POST['TransferenciaVocero'])
      $this->render('avanzar', array('model' => $model));
		} // fin else ($model->id_estado
        }


	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'TransferenciaVocero')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('TransferenciaVocero');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new TransferenciaVocero('search');
		$model->unsetAttributes();

		if (isset($_GET['TransferenciaVocero']))
			$model->setAttributes($_GET['TransferenciaVocero']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
