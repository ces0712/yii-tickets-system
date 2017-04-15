<?php

class CooperativistaController extends GxController {

	protected function filterGridDataJornada() {
		$data = array();
		$condicion = 'estatus = true';
		$models = Jornada::model()->findAll($condition=$condicion);
		foreach ($models as $model_jornada)
    			$data[$model_jornada->id] = $model_jornada->nombre;  
		return $data;
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
			'model' => $this->loadModel($id, 'Cooperativista'),
		));
	}

	public function actionCreate() {
		$model = new Cooperativista;

		$this->performAjaxValidation($model, 'cooperativista-form');

		if (isset($_POST['Cooperativista'])) {
			$model->setAttributes($_POST['Cooperativista']);
			$fecha =  date('Y-m-d H:i:s');
			$model->fecha_creacion = $fecha;			

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Cooperativista');

		$this->performAjaxValidation($model, 'cooperativista-form');

		if (isset($_POST['Cooperativista'])) {
			$model->setAttributes($_POST['Cooperativista']);
			$fecha =  date('Y-m-d H:i:s');
			$model->fecha_creacion = $fecha;

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Cooperativista')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Cooperativista');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Cooperativista('search');
		$model->unsetAttributes();

		if (isset($_GET['Cooperativista']))
			$model->setAttributes($_GET['Cooperativista']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

	protected function getVocero() {
		$models = Vocero::model()->findAll();
		$data = array();

    foreach ($models as $model_vocero)
      $data[$model_vocero->id] = $model_vocero->nombres . ' '. $model_vocero->apellidos;

    return $data;
	}

	protected function validarTransferenciaExistente($model, $id_estado) {
		$result = array();
		$criteria = new CDbCriteria;
		$criteria->select='count(1) as contar';
		$criteria->addInCondition('id_cooperativista',$model->selectedIds);
		$criteria->addCondition('id_jornada =:id_jornada and id_estado =:id_estado');
    $criteria->params[':id_jornada'] = $model->id_jornada;
    $criteria->params[':id_estado'] = $id_estado;

    $data = TransferenciaCooperativa::model()->find($criteria);

		if ($data->contar > 0) {
			$result['validacion'] = false;
			$result['message'] = 'Presenta '.$data->contar.' cooperativistas registrados en esta jornada por favor verifique las transferencias existentes';
		}else {
			$result['validacion'] = true;
			$result['message'] = 'Paso validacion';
		}
		return $result;
	}

	protected function validarCampos($model,$jornada) {
		$result = array();
		if ($model->id_jornada === '') {
			$result['validacion'] = false;
			$result['message'] = 'Error Debe seleccionar la jornada';
		}else if ($model->referencia_bancaria === '') {
			$result['validacion'] = false;
			$result['message'] = 'Error Ingresar un referencia_bancaria';
		}else if ($model->monto_transferido === '') {
			$result['validacion'] = false;
			$result['message'] = 'Error Ingresar un monto';
		}else if ($model->id_banco === '') {
			$result['validacion'] = false;
			$result['message'] = 'Error Debe seleccionar un banco';
		}else if ($model->id_depositante === '') {
			$result['validacion'] = false;
			$result['message'] = 'Error Debe seleccionar un depositante';
		}else if ($model->id_vocero === '') {
			$result['validacion'] = false;
			$result['message'] = 'Error Debe seleccionar un vocero';
		}else if (count($model->selectedIds) === 0) {
			$result['validacion'] = false;
			$result['message'] = 'Error Debe seleccionar por lo menos un cooperativista';
		}else {
			$cantidad_cooperativistas = count($model->selectedIds);
			$monto_estimado = $jornada->monto_estimado; // Valor total de la jornada
			$monto_transferido = $model->monto_transferido; // Total a transferir por parte de la cooperativa
			// Calculo de la cantidad de personas que pueden comprar en base al monto_transferido
			$cantidad_compradores_por_monto = $monto_transferido/$monto_estimado;
			$diferencia = $cantidad_cooperativistas - $cantidad_compradores_por_monto;


			if ($diferencia === 0 ) {
				$result['validacion'] = true;
				$result['message'] = 'Paso validacion';
			}else if ($diferencia > 0) {
				$result['validacion'] = false;
				$result['message'] = 'Error el monto ingresado no es suficiente para la cantidad de cooperativistas ingresada';
			}else {
				$result['validacion'] = false;
				$result['message'] = 'Error el monto ingresado es superior al requerido';
			}
		}
		// echo $cantidad_compradores_por_monto; // 3
		// echo $cantidad_cooperativistas; // 2
		// die();

		return $result;

	}

	public function actionGenerarTransferencia() {
		$model = new Cooperativista('search_generar_transferencia');
		$this->performAjaxValidation($model, 'generar-transferencia-cooperativa-form');
		$message = array();

		$model->unsetAttributes();

		if (isset($_GET['Cooperativista'])) {
			$model->setAttributes($_GET['Cooperativista']);
		} else if (isset($_POST['Cooperativista'])) {
			$model->setAttributes($_POST['Cooperativista']);
			$model->selectedIds = $_POST['selectedIds'];
			$fecha = date('Y-m-d');
			$id_estado = 10; // Pendiente por crear ticket
			$id_tipo_empleado = 2; // Tipo de empleado Cooperativa
			$i = 0;
			$selectedIds = $model->selectedIds;

			$jornada = Jornada::model()->findByPk($model->id_jornada);
			$validarCampos = $this->validarCampos($model,$jornada);
			if ($validarCampos['validacion'] === false) {
				$message['warning'] = $validarCampos['message'];
			}else if ($validarCampos['validacion'] === true) {
				$validarTransferencia = $this->validarTransferenciaExistente($model, $id_estado);
				if ($validarTransferencia['validacion'] === false) {
					$message['warning'] = $validarTransferencia['message'];
				}else if ($validarTransferencia['validacion'] === true) {
					foreach ($selectedIds as $id_cooperativista) {
						$modelTransferencia = new TransferenciaCooperativa;
						$modelTransferencia->id_cooperativista = $id_cooperativista;
						$modelTransferencia->id_depositante = $model->id_depositante;
						$modelTransferencia->id_vocero = $model->id_vocero;
						$modelTransferencia->id_banco = $model->id_banco;
						$modelTransferencia->referencia_bancaria = $model->referencia_bancaria;
						$modelTransferencia->fecha_creacion = $fecha;
						$modelTransferencia->id_estado = $id_estado;
						$modelTransferencia->monto_transferido = $model->monto_transferido;
						$modelTransferencia->id_jornada = $model->id_jornada;
						if ($modelTransferencia->save()) {
							// Buscar los datos del cooperativista la cedula
							$cooperativista = Cooperativista::model()->findByPk($id_cooperativista);
							// Cargar masivamente con los id_cooperativista en la tabla de tickets
							$modelTickets = new Tickets;
							$modelTickets->cedula = $cooperativista->cedula;
							$modelTickets->monto = $jornada->monto_estimado;
							$modelTickets->estado_flujo = $id_estado;
							$modelTickets->id_banco = $model->id_banco;
							$modelTickets->id_vocero = $model->id_vocero;
							$modelTickets->id_jornada = $model->id_jornada;
							$modelTickets->id_depositante = $model->id_depositante;
							$modelTickets->bauche = $model->referencia_bancaria;
							$modelTickets->id_tipo_empleado = $id_tipo_empleado;
							if ($modelTickets->save()) {
								$i++;
							}
						} // fin de if $modelTransferencia->save()
					} // fin de foreach
				} // fin else if $validarTransferencia == true
			} // fin else if $validarMonto['validacion']
			if (count($message['warning']) === 0) {
				if (count($selectedIds) !== $i) {
					$message['error'] = 'Hubo un Error en la Operacion';
				} else {
					$message['success'] = 'Cooperativistas Registrados en la Cola de forma exitosa';
				}
			} // fin if count($message['info']) 
			$model->message = $message;	
		} // fin isset $_POST
		$this->render('adminGenerarTransferencia', array(
			'model' => $model,
		));
	}

}