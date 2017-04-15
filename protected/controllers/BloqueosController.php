<?php

class BloqueosController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Bloqueos'),
		));
	}

	public function actionCreate() {
		$model = new Bloqueos;

		$this->performAjaxValidation($model, 'bloqueos-form');

		if (isset($_POST['Bloqueos'])) {
			$model->setAttributes($_POST['Bloqueos']);

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
		$model = $this->loadModel($id, 'Bloqueos');

		$this->performAjaxValidation($model, 'bloqueos-form');

		if (isset($_POST['Bloqueos'])) {
			$model->setAttributes($_POST['Bloqueos']);

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
			$this->loadModel($id, 'Bloqueos')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Bloqueos');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Bloqueos('search');
		$model->unsetAttributes();

		if (isset($_GET['Bloqueos']))
			$model->setAttributes($_GET['Bloqueos']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}