<?php


namespace Linwebs\SimpleMessageBoard\Database;


use PDOException;

class Init {
	public function init() {
		if (!$this->create_table_user()) {
			return false;
		}
		if (!$this->create_table_note()) {
			return false;
		}
		return true;
	}

	private function create_table_user() {
		$connect = Database::connect();
		try {
			$sql = 'CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci';
			$stmt = $connect->prepare($sql);
			return $stmt->execute();
		} catch (PDOException $exception) {
			die('DB CREATE Table failed: ' . $exception->getMessage());
		}
	}

	private function create_table_note() {
		$connect = Database::connect();
		try {
			$sql = 'CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_note_user`
    FOREIGN KEY (`user`) REFERENCES `user`(`id`)
    ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci';
			$stmt = $connect->prepare($sql);
			return $stmt->execute();
		} catch (PDOException $exception) {
			die('DB CREATE Table failed: ' . $exception->getMessage());
		}
	}
}
