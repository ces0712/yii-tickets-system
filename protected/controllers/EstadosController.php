<?php

class EstadosController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Estados'),
		));
	}

	public function actionCreate() {
		$model = new Estados;

		$this->performAjaxValidation($model, 'estados-form');

		if (isset($_POST['Estados'])) {
			$model->setAttributes($_POST['Estados']);

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
		$model = $this->loadModel($id, 'Estados');

		$this->performAjaxValidation($model, 'estados-form');

		if (isset($_POST['Estados'])) {
			$model->setAttributes($_POST['Estados']);

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
			$this->loadModel($id, 'Estados')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Estados');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Estados('search');
		$model->unsetAttributes();

		if (isset($_GET['Estados']))
			$model->setAttributes($_GET['Estados']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}