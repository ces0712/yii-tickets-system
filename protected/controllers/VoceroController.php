<?php

class VoceroController extends GxController {

	protected function setTipoVocero($model,$modulo) {
		 $n = 0;
		 $model->setAttributes($_POST['Vocero']);
                 $model->fecha_creacion = date('Y-m-d H:i:s');
		 if ($modulo === 'u') {
                 	Vocerotipovocero::model()->deleteAll(
                        	$condition  = 'id_vocero = :someVarName',
                       		$params     = array(
                        	':someVarName' => $model->id,
                        ));
                        $modulo = 'c';
                 }
                 if ($model->save()) {
			foreach( $_POST['Vocero']['ids_tipo_vocero'] as $id_tipo_vocero ) {		
		 		if($modulo === 'c') {
					$modelVocerotipovocero = new Vocerotipovocero;
					$modelVocerotipovocero->id_vocero = $model->id;
					$modelVocerotipovocero->id_tipo_vocero = $id_tipo_vocero;
					$modelVocerotipovocero->save();
				}
				$n++;
			}
		 }
		 return $n;
	}


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Vocero'),
		));
	}

	public function actionCreate() {
		$model = new Vocero;

		$this->performAjaxValidation($model, 'vocero-form');

		if (isset($_POST['Vocero'])) {
			$model->setAttributes($_POST['Vocero']);
			// $model->fecha_creacion = date('Y-m-d H:i:s');
			$modulo = 'c';
			$n = $this->setTipoVocero($model, $modulo);

			if ($n > 0) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Vocero');
		$ids_tipo_vocero = array();
		$i = 0;
		$encontrarTiposVoceros = Vocerotipovocero::model()->findAll(
                                $condition  = 'id_vocero = :someVarName',
                                $params     = array(
                                ':someVarName' => (int)$id,
                ));
		foreach($encontrarTiposVoceros as $vocerotipovocero) {
			$ids_tipo_vocero[$i] = $vocerotipovocero->id_tipo_vocero;
			$i++;	
		}
		$model->ids_tipo_vocero = $ids_tipo_vocero;
		$this->performAjaxValidation($model, 'vocero-form');

		if (isset($_POST['Vocero'])) {
			$modulo = 'u';
			$n = $this->setTipoVocero($model, $modulo);
			if ($n > 0) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Vocero')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Vocero');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Vocero('search');
		$model->unsetAttributes();

		if (isset($_GET['Vocero']))
			$model->setAttributes($_GET['Vocero']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
