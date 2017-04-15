<?php

class JornadaController extends GxController {
	
	protected function setJornada($model,$modulo) {
		 $n = 0;
		 $model->setAttributes($_POST['Jornada']);
                 $model->fecha_creacion = date('Y-m-d H:i:s');
		 if ($modulo === 'u') {
                 	Jornadarubro::model()->deleteAll(
                        	$condition  = 'id_jornada = :someVarName',
                       		$params     = array(
                        	':someVarName' => $model->id,
                        ));
                        $modulo = 'c';
                 }
                 if ($model->save()) {
			foreach( $_POST['Jornada']['ids_rubro'] as $id_rubro ) {		
		 		if($modulo === 'c') {
					$modelJornadaRubro = new Jornadarubro;
					$modelJornadaRubro->id_jornada = $model->id;
					$modelJornadaRubro->id_rubro = $id_rubro;
					$modelJornadaRubro->save();
				}
				$n++;
			}
		 }
		 return $n;
	}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Jornada'),
		));
	}

	public function actionCreate() {
		$model = new Jornada;

		$this->performAjaxValidation($model, 'jornada-form');

		if (isset($_POST['Jornada'])) {
			$modulo = 'c';
			$n = $this->setJornada($model, $modulo);
			if ( $n > 0 )  {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Jornada');
		$ids_rubro = array();
		$i = 0;
		$encontrarRubros = Jornadarubro::model()->findAll(
                                $condition  = 'id_jornada = :someVarName',
                                $params     = array(
                                ':someVarName' => (int)$id,
                ));
		foreach($encontrarRubros as $jornadarubro) {
			$ids_rubro[$i] = $jornadarubro->id_rubro;
			$i++;	
		}
		$model->ids_rubro = $ids_rubro;
		$this->performAjaxValidation($model, 'jornada-form');

		if (isset($_POST['Jornada'])) {
			$modulo = 'u';
			$n = $this->setJornada($model, $modulo);
			if ($n > 0) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}
	
	public function actionUpdateJornada($ids) {
		$arre_id = preg_split("/[\{},]+/", $ids,-1,PREG_SPLIT_NO_EMPTY);
                $model = $this->loadModel($arre_id[0], 'Jornada');
		$arre_rubros_id = array();
		$n=0;

		foreach($arre_id as $id) {
			$jornada = Jornada::model()->findByPk($id);
			$arre_rubros_id[$n] = $jornada->id_rubro;
			$n++;
		}

		$model->ids_rubro = $arre_rubros_id;
                $this->performAjaxValidation($model, 'jornada-form');

                if (isset($_POST['Jornada'])) {
                        // $model->setAttributes($_POST['Jornada']);
		 	$i = 0;
			$lon_arre_ids_rubro = count($_POST['Jornada']['ids_rubro']);
			$lon_arre_id = count($arre_id);
			$total_eliminar = $n - $lon_arre_ids_rubro;
			if($total_eliminar > 0) {
                        	foreach( $_POST['Jornada']['ids_rubro'] as $id_rubro ) {
					if (($key = array_search($id_rubro, $arre_rubros_id)) !== NULL) {
    						unset($arre_rubros_id[$key]);
					}
				}
				foreach (array_keys($arre_rubros_id) as $k) {
					$this->loadModel($arre_id[$k], 'Jornada')->delete();
					unset($arre_id[$k]);
				}
				foreach ($arre_id as $a) {
					$model1 = $this->loadModel($a, 'Jornada');
					$this->setJornada($model1,$_POST['Jornada']['ids_rubro'][$i]);
					$i++;
				}


			}else {
				// die();
                        	foreach( $_POST['Jornada']['ids_rubro'] as $id_rubro ) {
				
					if($i >= $lon_arre_id) {
						$model1 = new Jornada;			
					}else {
                                		$model1 = $this->loadModel($arre_id[$i], 'Jornada');
					}
                                	$model1->setAttributes($_POST['Jornada']);
                                	$model1->fecha_creacion = date('Y-m-d H:i:s');
                                	$model1->id_rubro = $id_rubro;
                                	$model1->save();
                                	$i++;
                        	}
			} // fin del for $total_eliminar 

                        if ($i > 0) {
                                $this->redirect(array('view', 'id' => $model1->id));
                        }
                } // fin if isset $_POST['Jornada']

                $this->render('updateJornada', array(
                                'model' => $model,
                                ));
        }

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Jornada')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Jornada');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Jornada('search');
		$model->unsetAttributes();

		if (isset($_GET['Jornada']))
			$model->setAttributes($_GET['Jornada']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

	 public function actionAdminJornadaRubro() {
                $model = new Jornada('search');
                $model->unsetAttributes();

                if (isset($_GET['Jornada']))
                        $model->setAttributes($_GET['Jornada']);

                $this->render('adminJornadaRubro', array(
                        'model' => $model,
                ));
        }


}
