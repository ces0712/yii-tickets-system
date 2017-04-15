<?php

class MantenimientoController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Mantenimiento'),
		));
	}
	
	public function actionReportico() {
		$this->redirect('http://tuticketclap.cantv.net/reporteador/index.php/reportico');
	}

	public function actionCreate() {
		$model = new Mantenimiento;

		$this->performAjaxValidation($model, 'mantenimiento-form');

		if (isset($_POST['Mantenimiento'])) {
			$model->setAttributes($_POST['Mantenimiento']);

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
		$model = $this->loadModel($id, 'Mantenimiento');

		$this->performAjaxValidation($model, 'mantenimiento-form');

		if (isset($_POST['Mantenimiento'])) {
			$model->setAttributes($_POST['Mantenimiento']);

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
			$this->loadModel($id, 'Mantenimiento')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Mantenimiento');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Mantenimiento('search');
		$model->unsetAttributes();

		if (isset($_GET['Mantenimiento']))
			$model->setAttributes($_GET['Mantenimiento']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
