<?php

class TipoCooperativaController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'TipoCooperativa'),
		));
	}

	public function actionCreate() {
		$model = new TipoCooperativa;

		$this->performAjaxValidation($model, 'tipo-cooperativa-form');

		if (isset($_POST['TipoCooperativa'])) {
			$model->setAttributes($_POST['TipoCooperativa']);
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
		$model = $this->loadModel($id, 'TipoCooperativa');

		$this->performAjaxValidation($model, 'tipo-cooperativa-form');

		if (isset($_POST['TipoCooperativa'])) {
			$model->setAttributes($_POST['TipoCooperativa']);
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
			$this->loadModel($id, 'TipoCooperativa')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('TipoCooperativa');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new TipoCooperativa('search');
		$model->unsetAttributes();

		if (isset($_GET['TipoCooperativa']))
			$model->setAttributes($_GET['TipoCooperativa']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}