<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	public function actionListadoEmpleados()
        {
                $model=new ContactForm;
                if(isset($_POST['ContactForm']))
                {
                        $model->attributes=$_POST['ContactForm'];
                        if($model->validate())
                        {
                                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                                $headers="From: $name <{$model->email}>\r\n".
                                        "Reply-To: {$model->email}\r\n".
                                        "MIME-Version: 1.0\r\n".
                                        "Content-Type: text/plain; charset=UTF-8";

                                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                                $this->refresh();
                        }
                }
                $this->render('listadoEmpleados',array('model'=>$model));
        }

	public function actionListadoCooperativistas()
        {
                $model=new ContactForm;
                if(isset($_POST['ContactForm']))
                {
                        $model->attributes=$_POST['ContactForm'];
                        if($model->validate())
                        {
                                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                                $headers="From: $name <{$model->email}>\r\n".
                                        "Reply-To: {$model->email}\r\n".
                                        "MIME-Version: 1.0\r\n".
                                        "Content-Type: text/plain; charset=UTF-8";

                                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                                $this->refresh();
                        }
                }
                $this->render('listadoCooperativistas',array('model'=>$model));
        }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']) && isset($_POST['Tipoempleado']))
		{
			$model->attributes=$_POST['LoginForm'];
			$model->tipoempleado = $_POST['Tipoempleado']['id_tipo_empleado'];
			// validate user input and redirect to the previous page if valid
			if($model->validate()){
			    $encontrarRegistros = Registros::model()->count("ced_empleado=:ced_empleado and estatus=:estatus", array("ced_empleado" => $model->password,"estatus"=>'true'));
			    $encontrarAdministrador = Administrador::model()->count("cedula=:cedula and estatus=:estatus", array("cedula" => $model->password,"estatus"=>'true'));
			    if ($encontrarAdministrador > 0 && $model->login()){
				Yii::app()->session['idtipoempleado'] = $model->tipoempleado;
                                Yii::app()->session['cedula'] = $model->password;
                                Yii::app()->session['admin'] = 'true';
				$this->redirect('index.php?r=registros/admin');
			    }
			    if($encontrarAdministrador == 0 && $encontrarRegistros == 0 && $model->login()){
			    	Yii::app()->session['idtipoempleado'] = $model->tipoempleado;	
			    	Yii::app()->session['cedula'] = $model->password;
				$this->redirect('index.php?r=registros/create');
			    }else
				if ($encontrarAdministrador == 0 && $encontrarRegistros > 0){
					if($model->tipoempleado == '2'){
                                		$encontrarEmpleado = Empleados::model()->find("cedula=:cedula", array("cedula" => $model->password));
						$nombreEmpleado = $encontrarEmpleado->nombres." ".$encontrarEmpleado->apellidos;
					}
                        		if($model->tipoempleado == '1'){
                                		$encontrarEmpleado = Cooperativistas::model()->find("cedula=:cedula", array("cedula" => $model->password));
						$nombreEmpleado = $encontrarEmpleado->nombre1." ".$encontrarEmpleado->apellido1;
					}
					$encontrarRegistro = Registros::model()->find("ced_empleado=:ced_empleado", array("ced_empleado" => $model->password));					      
					$week = $encontrarEmpleado->num_semana;
					$year = date('Y');
					$fechaInicioSemana  = date('d-m-Y', strtotime($year . 'W' . str_pad($week , 2, '0', STR_PAD_LEFT)));
					$fecha_sabado = date('d-m-Y', strtotime($fechaInicioSemana.' 5 day')); //Domingo
					//$fecha = "Desde: ".$fechaInicioSemana." 	Hasta: ".$fecha_domingo;
					 Yii::app()->session['fecha'] = $fecha_sabado; 	
					 Yii::app()->session['cedula'] = $encontrarRegistro->ced_empleado;
					 Yii::app()->session['voucher'] = $encontrarRegistro->voucher;
					 Yii::app()->session['nombre'] = $nombreEmpleado;
					 
					
					$this->redirect('index.php?r=site/contact');
				}
			   
			}
		} 	
		
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
