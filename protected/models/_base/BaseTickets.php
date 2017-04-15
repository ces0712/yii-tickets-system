<?php

/**
 * This is the model base class for the table "tickets".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Tickets".
 *
 * Columns in table "tickets" available as properties of the model,
 * followed by relations of table "tickets" available as properties of the model.
 *
 * @property integer $id
 * @property boolean $estatus
 * @property integer $cedula
 * @property string $numero_cedula
 * @property string $rubros
 * @property integer $estado_flujo
 * @property integer $rubro_id
 * @property string $hora_asistencia
 * @property string $hora_asistencia_tentativa
 * @property boolean $retener_rubro
 * @property boolean $atencion_preferencial
 * @property integer $id_banco
 * @property integer $id_vocero
 * @property integer $id_jornada
 * @property string $bauche
 * @property integer $p00
 * @property double $monto
 * @property integer $id_depositante
 * @property string $observacion_vocero
 * @property string $hora_finalizacion
 * @property integer $id_tipo_empleado
 * @property integer $id_vocero_sede
 * @property integer $id_vocero_piso
 * @property integer $id_vocero_edificio
 *
 * @property Estados $estadoFlujo
 * @property Rubros $rubro
 * @property Bancos $idBanco
 * @property Vocero $idVocero
 * @property Jornada $idJornada
 * @property Depositante $idDepositante
 * @property TipoEmpleado $idTipoEmpleado
 * @property Vocero $idVoceroSede
 * @property Vocero $idVoceroEdificio
 * @property Vocero $idVoceroPiso
 */
abstract class BaseTickets extends GxActiveRecord {
	public $monto_acumulado;
	public $voceros;
	public $depositantes;

	public function getVocero() {
		$vocero = '';
		if(isset($this->id_vocero)) {
			$model_vocero = Vocero::model()->findByPk($this->id_vocero);

                        $vocero = $model_vocero->nombres . ' '. $model_vocero->apellidos;

		}
  		return $vocero;
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tickets';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Tickets|Tickets', $n);
	}

	public static function representingColumn() {
		return 'numero_cedula';
	}

	public function rules() {
		return array(
			array('cedula, id_banco, id_vocero, id_jornada, bauche, monto, id_depositante', 'required'),
			array('cedula, estado_flujo, rubro_id, id_banco, id_vocero, id_jornada, p00, id_depositante, id_tipo_empleado, id_vocero_sede, id_vocero_piso, id_vocero_edificio ', 'numerical', 'integerOnly'=>true),
			// array('cedula', 'unique', 'message' => "Cedula ya registrada"),
			array('monto, bauche', 'numerical'),
			// array('bauche', 'length', 'max'=>30),
			array('estatus, numero_cedula, rubros, hora_asistencia, hora_asistencia_tentativa, retener_rubro, atencion_preferencial, observacion_vocero, hora_finalizacion', 'safe'),
			array('estatus, numero_cedula, rubros, estado_flujo, rubro_id, hora_asistencia, hora_asistencia_tentativa, retener_rubro, atencion_preferencial, p00, observacion_vocero, hora_finalizacion, id_tipo_empleado, id_vocero_sede, id_vocero_piso, id_vocero_edificio', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, estatus, cedula, numero_cedula, rubros, estado_flujo, rubro_id, hora_asistencia, hora_asistencia_tentativa, retener_rubro, atencion_preferencial, id_banco, id_vocero, id_jornada, bauche, p00, monto, id_depositante, observacion_vocero, hora_finalizacion, id_tipo_empleado, id_vocero_sede, id_vocero_piso, id_vocero_edificio', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'estadoFlujo' => array(self::BELONGS_TO, 'Estados', 'estado_flujo'),
			'rubro' => array(self::BELONGS_TO, 'Rubros', 'rubro_id'),
			'idBanco' => array(self::BELONGS_TO, 'Bancos', 'id_banco'),
			'idVocero' => array(self::BELONGS_TO, 'Vocero', 'id_vocero'),
			'idJornada' => array(self::BELONGS_TO, 'Jornada', 'id_jornada'),
			'idDepositante' => array(self::BELONGS_TO, 'Depositante', 'id_depositante'),
			'idTipoEmpleado' => array(self::BELONGS_TO, 'TipoEmpleado', 'id_tipo_empleado'),
			'idVoceroSede' => array(self::BELONGS_TO, 'Vocero', 'id_vocero_sede'),
			'idVoceroEdificio' => array(self::BELONGS_TO, 'Vocero', 'id_vocero_edificio'),
			'idVoceroPiso' => array(self::BELONGS_TO, 'Vocero', 'id_vocero_piso'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'Numero de Ticket'),
			'estatus' => Yii::t('app', 'Estatus'),
			'cedula' => Yii::t('app', 'Cedula del Trabajador'),
			'numero_cedula' => Yii::t('app', 'Cedula-NumeroTicket'),
			'rubros' => Yii::t('app', 'Rubros'),
			'estado_flujo' => null,
			'rubro_id' => null,
			'hora_asistencia' => Yii::t('app', 'Hora Asistencia'),
			'hora_asistencia_tentativa' => Yii::t('app', 'Hora Asistencia Tentativa'),
			'retener_rubro' => Yii::t('app', 'Retener Rubro'),
			'atencion_preferencial' => Yii::t('app', 'Atencion Preferencial'),
			'id_banco' => null,
			'id_vocero' => null,
			'id_jornada' => null,
			'bauche' => Yii::t('app', 'Bauche'),
			'p00' => Yii::t('app', 'P00'),
			'monto' => Yii::t('app', 'Monto'),
			'id_depositante' => null,
			'observacion_vocero' => Yii::t('app', 'Observacion de Vocero'),
			'hora_finalizacion' => Yii::t('app', 'Hora Finalizacion'),
			'id_tipo_empleado' => null,
			'id_vocero_sede' => null,
			'id_vocero_piso' => null,
			'id_vocero_edificio' => null,
			'estadoFlujo' => null,
			'rubro' => null,
			'idBanco' => null,
			'idVocero' => null,
			'idJornada' => null,
			'idDepositante' => null,
			'idTipoEmpleado' => null,
			'idVoceroSede' => null,
			'idVoceroEdificio' => null,
			'idVoceroPiso' => null,

		);
	}

	public function search() {
		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('cedula', $this->cedula);
		$criteria->compare('numero_cedula', $this->numero_cedula, true);
		if (isset($_GET['Tickets']['id_jornada']) || isset($_GET['id_jornada'])) {
			if(isset($_GET['Tickets']['id_jornada']))
				$criteria->compare('id_jornada',$_GET['Tickets']['id_jornada']);
			else if(isset($_GET['id_jornada']))
				$criteria->compare('id_jornada',$_GET['id_jornada']);
			$criteria->addInCondition('estado_flujo',array(2,3)); // Estatus Asignado y en espera
			$criteria->addCondition('estatus =:estatus');
			$criteria->params[':estatus'] = 'true';
		}else {
			$criteria->compare('id_jornada', $this->id_jornada);
			$criteria->compare('estado_flujo', $this->estado_flujo);
			$criteria->compare('estatus', $this->estatus);
		}
		$criteria->compare('rubro_id', $this->rubro_id);
		$criteria->compare('hora_asistencia', $this->hora_asistencia, true);
		$criteria->compare('hora_asistencia_tentativa', $this->hora_asistencia_tentativa, true);
		$criteria->compare('retener_rubro', $this->retener_rubro);
		$criteria->compare('atencion_preferencial', $this->atencion_preferencial);
		$criteria->compare('id_banco', $this->id_banco);
		$criteria->compare('id_vocero', $this->id_vocero);
		$criteria->compare('bauche', $this->bauche, true);
		$criteria->compare('p00', $this->p00);
		$criteria->compare('monto', $this->monto);
		$criteria->compare('id_depositante', $this->id_depositante);
		$criteria->compare('observacion_vocero', $this->observacion_vocero, true);
		$criteria->compare('hora_finalizacion', $this->hora_finalizacion, true);
		$criteria->compare('id_tipo_empleado', $this->id_tipo_empleado);
		$criteria->compare('id_vocero_sede', $this->id_vocero_sede);
		$criteria->compare('id_vocero_piso', $this->id_vocero_piso);
		$criteria->compare('id_vocero_edificio', $this->id_vocero_edificio);
		$criteria->order='atencion_preferencial DESC, id ASC';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function search_decreciente() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('estatus', $this->estatus);
		$criteria->compare('cedula', $this->cedula);
		$criteria->compare('numero_cedula', $this->numero_cedula, true);
		if (isset($_GET['rubros'])) {
			$criteria->compare('rubros',$_GET['rubros'], true);
		}else
			$criteria->compare('rubros', $this->rubros, true);
		// $criteria->compare('estado_flujo', $this->estado_flujo);
		$criteria->compare('rubro_id', $this->rubro_id);
		$criteria->compare('hora_asistencia', $this->hora_asistencia, true);
		$criteria->compare('hora_asistencia_tentativa', $this->hora_asistencia_tentativa, true);
		$criteria->compare('retener_rubro', $this->retener_rubro);
		$criteria->compare('atencion_preferencial', $this->atencion_preferencial);
		$criteria->compare('id_banco', $this->id_banco);
		$criteria->compare('id_vocero', $this->id_vocero);
		$criteria->compare('id_jornada', $this->id_jornada);
		$criteria->compare('bauche', $this->bauche, true);
		$criteria->compare('p00', $this->p00);
		$criteria->compare('monto', $this->monto);
		$criteria->addInCondition('estado_flujo',array(1,2,3,4,5,10));
		$criteria->compare('id_depositante', $this->id_depositante);
		$criteria->compare('observacion_vocero', $this->observacion_vocero, true);
		$criteria->compare('hora_finalizacion', $this->hora_finalizacion, true);
		$criteria->compare('id_tipo_empleado', $this->id_tipo_empleado);
		$criteria->compare('id_vocero_sede', $this->id_vocero_sede);
		$criteria->compare('id_vocero_piso', $this->id_vocero_piso);
		$criteria->compare('id_vocero_edificio', $this->id_vocero_edificio);
    $criteria->addCondition('j.estatus = true');
    $criteria->join .= 'INNER JOIN jornada as j ON t.id_jornada = j.id';

		$criteria->order='id DESC';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function search_por_verificar() {
    $criteria = new CDbCriteria;
    $criteria->compare('id', $this->id);
    $criteria->compare('estatus', $this->estatus);
    $criteria->compare('cedula', $this->cedula);
    $criteria->compare('numero_cedula', $this->numero_cedula, true);
    if (isset($_GET['rubros'])) {
      $criteria->compare('rubros',$_GET['rubros'], true);
    }else
      $criteria->compare('rubros', $this->rubros, true);          
    $criteria->compare('rubro_id', $this->rubro_id);
    $criteria->compare('hora_asistencia', $this->hora_asistencia, true);
    $criteria->compare('hora_asistencia_tentativa', $this->hora_asistencia_tentativa, true);
    $criteria->compare('retener_rubro', $this->retener_rubro);
    $criteria->compare('atencion_preferencial', $this->atencion_preferencial);
    $criteria->compare('id_banco', $this->id_banco);
    $criteria->compare('id_vocero', $this->id_vocero);
    $criteria->compare('id_jornada', $this->id_jornada);
    $criteria->compare('bauche', $this->bauche, true);
    $criteria->compare('p00', $this->p00);
    $criteria->compare('monto', $this->monto);
		$criteria->compare('id_depositante', $this->id_depositante);
		$criteria->compare('observacion_vocero', $this->observacion_vocero, true);
		$criteria->addInCondition('estado_flujo',array(1,6,11));
		$criteria->compare('hora_finalizacion', $this->hora_finalizacion, true);
		$criteria->compare('id_tipo_empleado', $this->id_tipo_empleado);
		$criteria->compare('id_vocero_sede', $this->id_vocero_sede);
		$criteria->compare('id_vocero_piso', $this->id_vocero_piso);
		$criteria->compare('id_vocero_edificio', $this->id_vocero_edificio);
    $criteria->order='estado_flujo DESC, id ASC';

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
    ));
  }

  public function search_por_tickets_vocero() {
    $criteria = new CDbCriteria;
    $criteria->compare('id', $this->id);
    $criteria->compare('estatus', $this->estatus);
    $criteria->compare('cedula', $this->cedula);
    $criteria->compare('numero_cedula', $this->numero_cedula, true);
    if (isset($_GET['id_vocero']) && !isset($_GET['Tickets']['id_vocero'])) {
    	$criteria->compare('id_vocero', (int)$_GET['id_vocero']);
    }else {
    	$criteria->compare('id_vocero', $this->id_vocero);
    }

    if (isset($_GET['id_jornada']) && !isset($_GET['Tickets']['id_jornada'])) {
    	$criteria->compare('id_jornada', (int)$_GET['id_jornada']);
    }else {
    	$criteria->compare('id_jornada', $this->id_jornada);
    }

    $criteria->compare('rubro_id', $this->rubro_id);
    $criteria->compare('hora_asistencia', $this->hora_asistencia, true);
    $criteria->compare('hora_asistencia_tentativa', $this->hora_asistencia_tentativa, true);
    $criteria->compare('retener_rubro', $this->retener_rubro);
    $criteria->compare('atencion_preferencial', $this->atencion_preferencial);
    $criteria->compare('id_banco', $this->id_banco);
    $criteria->compare('id_vocero', $this->id_vocero);
    $criteria->compare('id_jornada', $this->id_jornada);
    $criteria->compare('bauche', $this->bauche, true);
    $criteria->compare('p00', $this->p00);
    $criteria->compare('monto', $this->monto);
		$criteria->compare('id_depositante', $this->id_depositante);
		$criteria->compare('observacion_vocero', $this->observacion_vocero, true);
		$criteria->addInCondition('estado_flujo',array(1,6,11));
		$criteria->compare('hora_finalizacion', $this->hora_finalizacion, true);
		$criteria->compare('id_tipo_empleado', $this->id_tipo_empleado);
		$criteria->compare('id_vocero_sede', $this->id_vocero_sede);
		$criteria->compare('id_vocero_piso', $this->id_vocero_piso);
		$criteria->compare('id_vocero_edificio', $this->id_vocero_edificio);
    $criteria->addCondition('j.estatus = true');
    $criteria->join = 'INNER JOIN jornada as j ON t.id_jornada = j.id';

    // $criteria->order='estado_flujo DESC, id ASC';

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
    ));
  }






}