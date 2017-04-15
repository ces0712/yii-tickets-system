<?php

class ProcesarArchivoVoceroController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ProcesarArchivoVocero'),
		));
	}

	public function actionCreate() {
		$model = new ProcesarArchivoVocero;

		$this->performAjaxValidation($model, 'procesar-archivo-vocero-form');

		if (isset($_POST['ProcesarArchivoVocero'])) {
			$model->setAttributes($_POST['ProcesarArchivoVocero']);

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
		$model = $this->loadModel($id, 'ProcesarArchivoVocero');

		$this->performAjaxValidation($model, 'procesar-archivo-vocero-form');

		if (isset($_POST['ProcesarArchivoVocero'])) {
			$model->setAttributes($_POST['ProcesarArchivoVocero']);

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
			$this->loadModel($id, 'ProcesarArchivoVocero')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('ProcesarArchivoVocero');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new ProcesarArchivoVocero('search');
		$model->unsetAttributes();

		if (isset($_GET['ProcesarArchivoVocero']))
			$model->setAttributes($_GET['ProcesarArchivoVocero']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}