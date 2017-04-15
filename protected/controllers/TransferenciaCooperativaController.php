<?php

class TransferenciaCooperativaController extends GxController {

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
			'model' => $this->loadModel($id, 'TransferenciaCooperativa'),
		));
	}

	public function actionCreate() {
		$model = new TransferenciaCooperativa;

		$this->performAjaxValidation($model, 'transferencia-cooperativa-form');

		if (isset($_POST['TransferenciaCooperativa'])) {
			$model->setAttributes($_POST['TransferenciaCooperativa']);
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
		$model = $this->loadModel($id, 'TransferenciaCooperativa');

		$this->performAjaxValidation($model, 'transferencia-cooperativa-form');

		if (isset($_POST['TransferenciaCooperativa'])) {
			$model->setAttributes($_POST['TransferenciaCooperativa']);
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
			$this->loadModel($id, 'TransferenciaCooperativa')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('TransferenciaCooperativa');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new TransferenciaCooperativa('search');
		$model->unsetAttributes();

		if (isset($_GET['TransferenciaCooperativa']))
			$model->setAttributes($_GET['TransferenciaCooperativa']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}