<?php

namespace Linwebs\SimpleMessageBoard\Database;

use PDO;
use PDOException;

class Database {
	/**
	 * Connect constructor.
	 * @return PDO
	 */
	public static function connect() {
		global $config;
		try {
			$connect = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'], $config['db_user_name'], $config['db_user_password']);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $connect;
		} catch (PDOException $exception) {
			die('DB connect failed: ' . $exception->getMessage());
		}
	}

	public static function connect_try(): bool {
		global $config;
		try {
			$connect = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'], $config['db_user_name'], $config['db_user_password']);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return self::check_table_exist();
		} catch (PDOException $exception) {
			return false;
		}
	}

	private static function check_table_exist(): bool {
		if (!self::check_table_note_exist()) {
			return false;
		}
		if (!self::check_table_user_exist()) {
			return false;
		}
		return true;
	}

	private static function check_table_note_exist(): bool {
		$connect = self::connect();
		try {
			$sql = 'SHOW TABLES LIKE :table';
			$stmt = $connect->prepare($sql);
			$stmt->bindValue(':table', 'note', PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if (empty($result)) {
				return false;
			}
			return true;
		} catch (PDOException $exception) {
			die('DB SHOW failed: ' . $exception->getMessage());
		}
	}

	private static function check_table_user_exist(): bool {
		$connect = self::connect();
		try {
			$sql = 'SHOW TABLES LIKE :table';
			$stmt = $connect->prepare($sql);
			$stmt->bindValue(':table', 'user', PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if (empty($result)) {
				return false;
			}
			return true;
		} catch (PDOException $exception) {
			die('DB SHOW failed: ' . $exception->getMessage());
		}
	}
}