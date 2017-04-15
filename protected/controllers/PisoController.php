<?php

class PisoController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Piso'),
		));
	}

	public function actionCreate() {
		$model = new Piso;

		$this->performAjaxValidation($model, 'piso-form');

		if (isset($_POST['Piso'])) {
			$model->setAttributes($_POST['Piso']);

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
		$model = $this->loadModel($id, 'Piso');

		$this->performAjaxValidation($model, 'piso-form');

		if (isset($_POST['Piso'])) {
			$model->setAttributes($_POST['Piso']);

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
			$this->loadModel($id, 'Piso')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Piso');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Piso('search');
		$model->unsetAttributes();

		if (isset($_GET['Piso']))
			$model->setAttributes($_GET['Piso']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}