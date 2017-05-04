<?php

namespace common\models;

Class ValueHelpers
{
	/**
	* return the value of a role name handed in as string
	* example: 'Administrador'
	*	
	* @param mixed $role_name
	*/
	public static function getRoleValue($role_name)
	{
		$connection = \Yii::$app->db;
			$sql = "SELECT role_value FROM role WHERE role_name=:role_name";
		$command = $connection->createCommand($sql);
		$command->bindValue(":role_name", $role_name);
		$result = $command->queryOne();
		return $result['role_value'];
	}
	/**
	* return the value of a status name handed in as string
	* example: 'Active'
	* @param mixed $status_name
	*/
	public static function getStatusValue($status_name)
	{
		$connection = \Yii::$app->db;
		$sql = "SELECT status_value FROM status WHERE status_name=:status_name";
		$command = $connection->createCommand($sql);
		$command->bindValue(":status_name", $status_name);
		$result = $command->queryOne();
		return $result['status_value'];
	}
	
}