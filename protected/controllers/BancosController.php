<?php

class BancosController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Bancos'),
		));
	}

	public function actionCreate() {
		$model = new Bancos;

		$this->performAjaxValidation($model, 'bancos-form');

		if (isset($_POST['Bancos'])) {
			$model->setAttributes($_POST['Bancos']);
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
		$model = $this->loadModel($id, 'Bancos');

		$this->performAjaxValidation($model, 'bancos-form');

		if (isset($_POST['Bancos'])) {
			$model->setAttributes($_POST['Bancos']);

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
			$this->loadModel($id, 'Bancos')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Bancos');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Bancos('search');
		$model->unsetAttributes();

		if (isset($_GET['Bancos']))
			$model->setAttributes($_GET['Bancos']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
