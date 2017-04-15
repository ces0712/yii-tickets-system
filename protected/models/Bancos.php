<?php

Yii::import('application.models._base.BaseBancos');

class Bancos extends BaseBancos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}