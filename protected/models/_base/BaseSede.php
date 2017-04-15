<?php

/**
 * This is the model base class for the table "sede".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Sede".
 *
 * Columns in table "sede" available as properties of the model,
 * followed by relations of table "sede" available as properties of the model.
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Vocero[] $voceros
 */
abstract class BaseSede extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'sede';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Sede|Sedes', $n);
	}

	public static function representingColumn() {
		return 'nombre';
	}

	public function rules() {
		return array(
			array('nombre', 'required'),
			array('nombre', 'length', 'max'=>150),
			array('id, nombre', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'voceros' => array(self::HAS_MANY, 'Vocero', 'id_sede'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'nombre' => Yii::t('app', 'Nombre'),
			'voceros' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('nombre', $this->nombre, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}