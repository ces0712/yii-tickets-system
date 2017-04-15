<?php

class DepositanteController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Depositante'),
		));
	}

	public function actionCreate() {
		$model = new Depositante;

		$this->performAjaxValidation($model, 'depositante-form');

		if (isset($_POST['Depositante'])) {
			$model->setAttributes($_POST['Depositante']);
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
		$model = $this->loadModel($id, 'Depositante');

		$this->performAjaxValidation($model, 'depositante-form');

		if (isset($_POST['Depositante'])) {
			$model->setAttributes($_POST['Depositante']);
			$model->fecha_creacion = date('Y-m-d H:i:s');

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
			$this->loadModel($id, 'Depositante')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Depositante');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Depositante('search');
		$model->unsetAttributes();

		if (isset($_GET['Depositante']))
			$model->setAttributes($_GET['Depositante']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
