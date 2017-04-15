<?php

class EdificioController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Edificio'),
		));
	}

	public function actionCreate() {
		$model = new Edificio;

		$this->performAjaxValidation($model, 'edificio-form');

		if (isset($_POST['Edificio'])) {
			$model->setAttributes($_POST['Edificio']);

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
		$model = $this->loadModel($id, 'Edificio');

		$this->performAjaxValidation($model, 'edificio-form');

		if (isset($_POST['Edificio'])) {
			$model->setAttributes($_POST['Edificio']);

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
			$this->loadModel($id, 'Edificio')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Edificio');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Edificio('search');
		$model->unsetAttributes();

		if (isset($_GET['Edificio']))
			$model->setAttributes($_GET['Edificio']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}