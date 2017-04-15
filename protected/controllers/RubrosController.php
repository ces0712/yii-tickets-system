<?php

class RubrosController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Rubros'),
		));
	}

	public function actionCreate() {
		$model = new Rubros;

		$this->performAjaxValidation($model, 'rubros-form');

		if (isset($_POST['Rubros'])) {
			$model->setAttributes($_POST['Rubros']);

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
		$model = $this->loadModel($id, 'Rubros');

		$this->performAjaxValidation($model, 'rubros-form');

		if (isset($_POST['Rubros'])) {
			$model->setAttributes($_POST['Rubros']);

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
			$this->loadModel($id, 'Rubros')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Rubros');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Rubros('search');
		$model->unsetAttributes();

		if (isset($_GET['Rubros']))
			$model->setAttributes($_GET['Rubros']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}