<?php

class SedeController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Sede'),
		));
	}

	public function actionCreate() {
		$model = new Sede;

		$this->performAjaxValidation($model, 'sede-form');

		if (isset($_POST['Sede'])) {
			$model->setAttributes($_POST['Sede']);

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
		$model = $this->loadModel($id, 'Sede');

		$this->performAjaxValidation($model, 'sede-form');

		if (isset($_POST['Sede'])) {
			$model->setAttributes($_POST['Sede']);

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
			$this->loadModel($id, 'Sede')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Sede');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Sede('search');
		$model->unsetAttributes();

		if (isset($_GET['Sede']))
			$model->setAttributes($_GET['Sede']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}