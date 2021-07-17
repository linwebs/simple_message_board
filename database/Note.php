<?php

namespace Linwebs\SimpleMessageBoard\Database;

use PDO;
use PDOException;

class Note {
	/**
	 * 新增留言
	 * @param string   $content
	 * @param int|null $user
	 * @return int
	 */
	public function add_note(string $content, int $user = null): int {
		$connect = Database::connect();
		try {
			$sql = 'INSERT INTO `note` (`id`, `content`, `user`, `status`, `time`) VALUES (NULL, :content, :user, :status, current_timestamp())';
			$stmt = $connect->prepare($sql);
			$stmt->bindValue(':content', $content, PDO::PARAM_STR);
			$stmt->bindValue(':user', $user, PDO::PARAM_INT);
			$stmt->bindValue(':status', 1, PDO::PARAM_INT);
			if ($stmt->execute()) {
				return $connect->lastInsertId();
			} else {
				return 0;
			}
		} catch (PDOException $exception) {
			if ($exception->getCode() == 22001) {
				return -2;
			} else {
				die('DB SELECT failed: ' . $exception->getMessage());
			}
		}
	}

	/**
	 * 取得所有留言
	 * @return array
	 */
	public function get_all_note(): array {
		$connect = Database::connect();
		try {
			$sql = 'SELECT `note`.`id`, `note`.`content`, `note`.`time`, `user`.`id` AS `user_id`, `user`.`account` AS `user_account`, `user`.`name` AS `user_name` FROM `note` LEFT JOIN `user` ON `note`.`user` = `user`.`id` ORDER BY `note`.`time` DESC';
			$stmt = $connect->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $exception) {
			die('DB SELECT failed: ' . $exception->getMessage());
		}
	}
}