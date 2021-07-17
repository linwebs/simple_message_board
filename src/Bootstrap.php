<?php

namespace Linwebs\SimpleMessageBoard\Src;

class Bootstrap {
	private $src;
	private $database;

	/**
	 * 系統起始點
	 */
	public function __construct() {
		$this->set_config();
		$this->session();
		$this->include();
		$this->variables();
		$this->login_check();
	}

	/**
	 * 配置設定檔
	 */
	private function set_config() {
		global $config, $html;

		require_once __DIR__ . '/../src/Init.php';

		$config_path = __DIR__ . '/../config.php';

		if (!is_file($config_path)) {
			if (substr($_SERVER['REQUEST_URI'], strlen($_SERVER['REQUEST_URI']) - strlen('/initialization'), strlen('/initialization')) == '/initialization') {
				$config['pre_url'] = substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI']) - strlen('/initialization'));
				$html['content'] = Init::init();
				require_once __DIR__ . '/../view/init/index.php';
			} else {
				require_once __DIR__ . '/../view/init/no_init.php';
			}
			die();
		}
		$config = include_once $config_path;

		Init::bootstrap_config();
	}

	/**
	 * 設置引入函式
	 */
	private function set_include() {
		$this->src = array('Router', 'Note', 'User', 'Init');

		$this->database = array('Database', 'Note', 'User');
	}

	/**
	 * 引入函式
	 */
	private function include() {
		$this->set_include();
		foreach ($this->src as $item) {
			require_once __DIR__ . '/../src/' . $item . '.php';
		}
		foreach ($this->database as $item) {
			require_once __DIR__ . '/../database/' . $item . '.php';
		}
	}

	/**
	 * 設置輸出變數預設內容
	 */
	private function variables() {
		global $html, $config;
		$html['navbar_name'] = $config['website_title'];
		$html['location'] = Router::url($config['pre_url'], 1);
	}

	/**
	 * 啟用 session
	 */
	private function session() {
		if (!isset($_SESSION)) {
			session_start();
		}
	}

	/**
	 * 檢查登入狀態
	 */
	private function login_check() {
		global $html;
		if (User::session_verify()) {
			$html['user_name'] = $_SESSION['user']['name'];
		} else {
			unset($_SESSION['user']['id']);
			unset($_SESSION['user']['name']);
			unset($_SESSION['user']['account']);
			$html['user_name'] = '';
		}
	}

	/**
	 * 顯示頁面
	 */
	public static function show_page() {
		global $config, $html;

		require_once __DIR__ . '/../view/index.php';
	}
}