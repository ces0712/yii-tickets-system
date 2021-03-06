<?php

/**
 * This is the model base class for the table "estados".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Estados".
 *
 * Columns in table "estados" available as properties of the model,
 * followed by relations of table "estados" available as properties of the model.
 *
 * @property integer $id
 * @property boolean $estatus
 * @property string $estado
 *
 * @property Tickets[] $tickets
 */
abstract class BaseEstados extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'estados';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Estados|Estadoses', $n);
	}

	public static function representingColumn() {
		return 'estado';
	}

	public function rules() {
		return array(
			array('estado', 'required'),
			array('estatus', 'safe'),
			array('estatus', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, estatus, estado', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'tickets' => array(self::HAS_MANY, 'Tickets', 'estado_flujo'),
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
			'estado' => Yii::t('app', 'Estado'),
			'tickets' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('estatus', $this->estatus);
		$criteria->compare('estado', $this->estado, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}