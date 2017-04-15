<?php

/**
 * This is the model base class for the table "batch_vocero".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "BatchVocero".
 *
 * Columns in table "batch_vocero" available as properties of the model,
 * followed by relations of table "batch_vocero" available as properties of the model.
 *
 * @property integer $id
 * @property boolean $estatus
 * @property string $fecha_referencia
 * @property string $referencia
 * @property string $descripcion
 * @property string $saldo
 * @property string $tipo
 * @property string $fecha_creacion
 * @property integer $id_procesar_archivo_vocero
 * @property double $debito
 * @property double $credito
 *
 * @property ProcesarArchivoVocero $idProcesarArchivoVocero
 */
abstract class BaseBatchVocero extends GxActiveRecord {
	public $file;
	public $message = array();
	public $id_jornada;
	public $id_depositante;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'batch_vocero';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Masiva de Titular de la Cuenta|Masiva de Titular de la Cuenta', $n);
	}

	public static function representingColumn() {
		return 'fecha_referencia';
	}

	public function rules() {
		return array(
			array('file', 'file', 
                                            'types'=>'csv',
                                            'maxSize'=>1024 * 1024 * 10, // 10MB
                                            'tooLarge'=>'El archivo pesa mas de 10MB por favor cargue un archivo menos pesado',
                                            'allowEmpty' => false
                              ),
			// array('fecha_referencia, referencia, descripcion, saldo, debito, credito, tipo', 'required'),
			array('id_procesar_archivo_vocero, id_jornada, id_depositante', 'numerical', 'integerOnly'=>true),
			array('debito, credito', 'numerical'),
			array('estatus, fecha_referencia, referencia, descripcion, saldo, tipo, fecha_creacion', 'safe'),
			array('estatus, fecha_referencia, referencia, descripcion, saldo, tipo, fecha_creacion, id_procesar_archivo_vocero, debito, credito, id_jornada, id_depositante', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, estatus, fecha_referencia, referencia, descripcion, saldo, tipo, fecha_creacion, id_procesar_archivo_vocero, debito, credito, id_jornada', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'idProcesarArchivoVocero' => array(self::BELONGS_TO, 'ProcesarArchivoVocero', 'id_procesar_archivo_vocero'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'estatus' => Yii::t('app', 'Estatus'),
			'fecha_referencia' => Yii::t('app', 'Fecha Referencia'),
			'referencia' => Yii::t('app', 'Referencia'),
			'descripcion' => Yii::t('app', 'Descripcion'),
			'saldo' => Yii::t('app', 'Saldo'),
			'tipo' => Yii::t('app', 'Tipo'),
			'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
			'file' =>  Yii::t('app', 'Seleccione el archivo'),
			'id_procesar_archivo_vocero' => null,
			'debito' => Yii::t('app', 'Debito'),
			'credito' => Yii::t('app', 'Credito'),
			'id_depositante' => Yii::t('app', 'Titular de la Cuenta'),
			'id_jornada' => Yii::t('app', 'Jornada'),

			'idProcesarArchivoVocero' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;
		$criteria->select='t.id, t.fecha_referencia, t.descripcion, t.saldo, t.debito, t.credito, t.referencia, p.id_jornada, p.id_depositante';
		$criteria->compare('id', $this->id);
		$criteria->compare('estatus', $this->estatus);
		$criteria->compare('fecha_referencia', $this->fecha_referencia, true);
		$criteria->compare('referencia', $this->referencia, true);
		$criteria->compare('descripcion', $this->descripcion, true);
		$criteria->compare('saldo', $this->saldo, true);
		$criteria->compare('tipo', $this->tipo, true);
		$criteria->compare('fecha_creacion', $this->fecha_creacion, true);
		$criteria->compare('id_procesar_archivo_vocero', $this->id_procesar_archivo_vocero);
		$criteria->compare('debito', $this->debito);
		$criteria->compare('credito', $this->credito);
		$criteria->compare('p.id_jornada', $this->id_jornada);
		$criteria->compare('p.id_depositante', $this->id_depositante);
		$criteria->addCondition('j.estatus = true');
		$criteria->join='INNER JOIN procesar_archivo_vocero as p ON t.id_procesar_archivo_vocero = p.id';
		$criteria->join .= 'INNER JOIN jornada as j ON p.id_jornada = j.id';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}





}