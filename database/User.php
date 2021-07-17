<?php

namespace Linwebs\SimpleMessageBoard\Database;

use PDO;
use PDOException;

class User {

	/**
	 * 登入驗證
	 * @param string $account 帳號
	 * @param string $password 密碼
	 * @return bool
	 */
	public function verify_user(string $account, string $password): bool {
		$connect = Database::connect();
		try {
			$sql = 'SELECT * FROM `user` WHERE `account` = :account AND `status` = 1';
			$stmt = $connect->prepare($sql);
			$stmt->bindValue(':account', $account, PDO::PARAM_STR);
			$stmt->execute();

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if (isset($result['password'])) {
				if (password_verify($password, $result['password'])) {
					return true;
				}
			}
			return false;
		} catch (PDOException $exception) {
			die('DB SELECT failed: ' . $exception->getMessage());
		}
	}

	/**
	 * 註冊使用者
	 * @param string $account 帳號
	 * @param string $password 密碼
	 * @param string $name 姓名
	 * @return int
	 */
	public function register(string $account, string $password, string $name): int {
		$connect = Database::connect();
		$hash_password = password_hash($password, PASSWORD_DEFAULT);
		try {
			$sql = 'INSERT INTO `user` (`id`, `name`, `account`, `password`, `status`) VALUES (NULL, :name, :account, :password, :status)';
			$stmt = $connect->prepare($sql);
			$stmt->bindValue(':name', $name, PDO::PARAM_STR);
			$stmt->bindValue(':account', $account, PDO::PARAM_STR);
			$stmt->bindValue(':password', $hash_password, PDO::PARAM_STR);
			$stmt->bindValue(':status', 1, PDO::PARAM_INT);
			if ($stmt->execute()) {
				return $connect->lastInsertId();
			} else {
				return 0;
			}
		} catch (PDOException $exception) {
			if ($exception->getCode() == 23000) {
				return -1;
			} elseif ($exception->getCode() == 22001) {
				return -2;
			} else {
				die('DB SELECT failed: ' . $exception->getMessage());
			}
		}
	}

	/**
	 * 取得單一使用者資訊
	 * @param string $account
	 * @return mixed
	 */
	public function get_single_user_info(string $account): mixed {
		$connect = Database::connect();
		try {
			$sql = 'SELECT `id`, `name`, `account` FROM `user` WHERE `account` = :account AND `status` = 1';
			$stmt = $connect->prepare($sql);
			$stmt->bindValue(':account', $account, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $exception) {
			die('DB SELECT failed: ' . $exception->getMessage());
		}
	}
}