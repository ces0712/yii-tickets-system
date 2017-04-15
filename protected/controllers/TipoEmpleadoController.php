<?php

class TipoEmpleadoController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'TipoEmpleado'),
		));
	}

	public function actionCreate() {
		$model = new TipoEmpleado;

		$this->performAjaxValidation($model, 'tipo-empleado-form');

		if (isset($_POST['TipoEmpleado'])) {
			$model->setAttributes($_POST['TipoEmpleado']);
			$model->fecha_creacion = date('Y-m-d');
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
		$model = $this->loadModel($id, 'TipoEmpleado');

		$this->performAjaxValidation($model, 'tipo-empleado-form');

		if (isset($_POST['TipoEmpleado'])) {
			$model->setAttributes($_POST['TipoEmpleado']);
			$model->fecha_creacion = date('Y-m-d');

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
			$this->loadModel($id, 'TipoEmpleado')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('TipoEmpleado');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new TipoEmpleado('search');
		$model->unsetAttributes();

		if (isset($_GET['TipoEmpleado']))
			$model->setAttributes($_GET['TipoEmpleado']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}