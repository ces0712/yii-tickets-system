<?php

class BatchVoceroController extends GxController {


	public function actions() {
	    return array(
	        'import'=>array('class'=>'ext.import.components.ImportModels', 'model'=>'BatchVocero'),
	        'template'=>array('class'=>'ext.import.components.ImportTemplate', 'model'=>'BatchVocero')
	    );
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

  protected function gridDataDepositante($data, $row) {
    $model_depositante = Depositante::model()->findByAttributes(array('id'=>$data->id_depositante));
    return $model_depositante->nombres_apellidos;

  }

  protected function filterGridDataDepositante() {
    $data = array();
    $models = Depositante::model()->findAll();
    foreach ($models as $model_depositante)
      $data[$model_depositante->id] = $model_depositante->nombres_apellidos;  
    return $data;

  }

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'BatchVocero'),
		));
	}

	public function actionCreate() {
		$model = new BatchVocero;

		$this->performAjaxValidation($model, 'batch-vocero-form');

		if (isset($_POST['BatchVocero'])) {
			$model->setAttributes($_POST['BatchVocero']);

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
		$model = $this->loadModel($id, 'BatchVocero');

		$this->performAjaxValidation($model, 'batch-vocero-form');

		if (isset($_POST['BatchVocero'])) {
			$model->setAttributes($_POST['BatchVocero']);

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
			$this->loadModel($id, 'BatchVocero')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('BatchVocero');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new BatchVocero('search');
		$model->unsetAttributes();

		if (isset($_GET['BatchVocero']))
			$model->setAttributes($_GET['BatchVocero']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

	protected function verificarExistencia($modelExiste) {
		// $set = array('estado_flujo' =>$model->id_estado);
		// fecha_referencia, referencia, descripcion, saldo, debito, credito, tipo);
		$condicion = 'tipo =:tipo and credito =:credito and debito =:debito and saldo =:saldo and descripcion =:descripcion and fecha_referencia =:fecha_referencia and referencia =:referencia';
    $p = array(':tipo' => $modelExiste->tipo);
    $p[':credito'] = $modelExiste->credito;
    $p[':debito'] = $modelExiste->debito;
    $p[':saldo'] = $modelExiste->saldo;
    $p[':descripcion'] = $modelExiste->descripcion;
    $p[':fecha_referencia'] = $modelExiste->fecha_referencia;
    $p[':referencia'] = $modelExiste->referencia;


    $result = BatchVocero::model()->find($condition = $condicion, $params = $p);

    return count($result);
	}

	public function actionUpload() {
		$model = new BatchVocero;
		$message = array();
		$message['success'] = array();
		$message['error'] = array();
		$id_estado = 12;
		// $message['warning'] = array();	
		// $model->message = $message;
		$delimiter = ",";
		$fecha = date('Y-m-d');
		// $this->performAjaxValidation($model, 'batch-vocero-form');

		if (isset($_POST['BatchVocero'])) {
			$model->setAttributes($_POST['BatchVocero']);

			if ($model->validate()) {	
				$csvFile=CUploadedFile::getInstance($model,'file');  
        $tempLocation=$csvFile->getTempName(); // sera borrado al terminar la ejecucion por php
        $modelProcesarArchivo = new ProcesarArchivoVocero;
        $modelProcesarArchivo->nombre = $csvFile->getName();
        $modelProcesarArchivo->id_jornada = $model->id_jornada;
        $modelProcesarArchivo->id_depositante = $model->id_depositante;
        $modelProcesarArchivo->fecha_creacion = $fecha;
        $modelProcesarArchivo->id_estado = $id_estado; // Archivo Cargado Exitosamente
        if($modelProcesarArchivo->save()) {
        	$model->id_procesar_archivo_vocero = $modelProcesarArchivo->id;
        }
        if (($handle = fopen($tempLocation, 'r')) !== false) {
        	// $row1 = fgetcsv($handle); // salto linea de encabezado
        	$i = 1;
        	while (!feof($handle)) {

	  						$row=fgetcsv($handle);

                if (count($row) === 1) {
                  $row = str_replace('"', '', $row[0]);
                  $row = explode(",", $row);
                }

                if (count($row) === 7) {
	  							/*if ((int)$row[4] === 0) {
	  								 $message['warning'][$i] = 'Linea '.$i.' No ha sido cargada porque presenta credito con monto 0';
	  							} else { */
				          	$modelNuevo = new BatchVocero;
				          	$time = date('Y-m-d',strtotime(str_replace('/', '-', $row[0])));
				          	$modelNuevo->fecha_referencia = $time;
				            $modelNuevo->referencia = $row[1];
				            $modelNuevo->descripcion = $row[2];
				            $modelNuevo->debito = (double)$row[3];
				            $modelNuevo->credito = (double)$row[4];
				            $modelNuevo->saldo = $row[5];
				            $modelNuevo->tipo = $row[6];
				            $modelNuevo->fecha_creacion = $fecha;
				            $modelNuevo->id_procesar_archivo_vocero = $model->id_procesar_archivo_vocero;
				            if ($this->verificarExistencia($modelNuevo) > 0) {
			            	  $message['error'][$i] = 'Linea '.$i.'Referencia '.$row[1].' Fue cargada previamente Error en la carga del archivo';
											$id_estado = 13;				            	
				            }else if ($modelNuevo->validate()) {
				            	$modelNuevo->save();
				            	  $message['success'][$i] = 'Linea '.$i.' Referencia '.$row[1].' Guardada exitosamente';
				            	  
				            } else {
				            	 $message['error'][$i] = 'Linea '.$i.' Error en la carga del archivo en la linea ';
				            	 $id_estado = 13; // Archivo Cargado con Errores
				            }
									// fin del else $row[4] === 0 }  
		            } // fin de if count($row)
	            $i++;
        	} // fin de while !eof
          fclose($handle);
          $model->message = $message;
          if (count($message['success']) === 0) {
          	$id_estado = 14; // Error en la carga del Archivo
          }
          if ($id_estado !== 12) {
      			$modelActualizarProcesarArchivo = $this->loadModel($model->id_procesar_archivo_vocero, 'ProcesarArchivoVocero');
      			$modelActualizarProcesarArchivo->id_estado = $id_estado;
      			$modelActualizarProcesarArchivo->save();    	
          }
        } // fin de if $handle
				
			} // fin if model validate			
		} // fin if isset
		$this->render('upload', array( 'model' => $model));
	}

}