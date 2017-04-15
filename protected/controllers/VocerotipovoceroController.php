<?php

class VocerotipovoceroController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Vocerotipovocero'),
		));
	}

	public function actionCreate() {
		$model = new Vocerotipovocero;

		$this->performAjaxValidation($model, 'vocerotipovocero-form');

		if (isset($_POST['Vocerotipovocero'])) {
			$model->setAttributes($_POST['Vocerotipovocero']);

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
		$model = $this->loadModel($id, 'Vocerotipovocero');

		$this->performAjaxValidation($model, 'vocerotipovocero-form');

		if (isset($_POST['Vocerotipovocero'])) {
			$model->setAttributes($_POST['Vocerotipovocero']);

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
			$this->loadModel($id, 'Vocerotipovocero')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Vocerotipovocero');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Vocerotipovocero('search');
		$model->unsetAttributes();

		if (isset($_GET['Vocerotipovocero']))
			$model->setAttributes($_GET['Vocerotipovocero']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
