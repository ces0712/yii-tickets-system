<?php

Yii::import('application.models._base.BaseBatchVocero');

class BatchVocero extends BaseBatchVocero
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}