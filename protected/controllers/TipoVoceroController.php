<?php

class TipoVoceroController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'TipoVocero'),
		));
	}

	public function actionCreate() {
		$model = new TipoVocero;

		$this->performAjaxValidation($model, 'tipo-vocero-form');

		if (isset($_POST['TipoVocero'])) {
			$model->setAttributes($_POST['TipoVocero']);
			$model->fecha_creacion = date('Y-m-d H:i:s');
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
		$model = $this->loadModel($id, 'TipoVocero');
		$model->fecha_creacion = date('Y-m-d H:i:s');
		$this->performAjaxValidation($model, 'tipo-vocero-form');

		if (isset($_POST['TipoVocero'])) {
			$model->setAttributes($_POST['TipoVocero']);

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
			$this->loadModel($id, 'TipoVocero')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('TipoVocero');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new TipoVocero('search');
		$model->unsetAttributes();

		if (isset($_GET['TipoVocero']))
			$model->setAttributes($_GET['TipoVocero']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
