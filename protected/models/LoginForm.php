<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;
	public $tipoempleado;
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			//array('username, password', 'required'),
			array('tipoempleado', 'safe'),
			array('password', 'required', 'message'=>'Cedula no puede ser nula'),
			array('password', 'match', 'pattern'=>'/^[0-9]+$/', 'message'=>'Coloque solo caracteres numericos'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
			'password'=>'Cedula (Ejemplo: 12345678)',
			'tipoempleado'=>'Tipo empleado',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			if($this->tipoempleado == '')
				 $this->addError('password','Debe seleccionar un tipo de empleado.');	
			if($this->tipoempleado == '2')
				$encontrarEmpleado = Empleados::model()->count("cedula=:cedula and num_semana>=:x", array("cedula" => $this->password,"x"=>43 ));
			if($this->tipoempleado == '1')
				$encontrarEmpleado = Cooperativistas::model()->count("cedula=:cedula and num_semana>=:x", array("cedula" => $this->password,"x"=>43));
			
			if($encontrarEmpleado == '0'){
				if($this->tipoempleado == '2')
					$this->addError('password',' Su Cedula no se encuentra registrada en la Base de datos como empleado Cantv y Movilnet de los Cortijos.');
				if($this->tipoempleado == '1')
					$this->addError('password','Su Cedula no se encuentra registrada en la Base de datos como Cooperativista de los Cortijos.');

			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
			$this->_identity = new UserIdentity($this->password, $this->password, $this->tipoempleado);
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
	}


}
