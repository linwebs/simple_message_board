<?php


namespace Linwebs\SimpleMessageBoard\Src;


use Linwebs\SimpleMessageBoard\Database\Database;

class Init {
	public static function init() {
		if ($_POST) {
			$html['content'] = self::install();
		} else {
			$html['content'] = self::intro();
		}
		$config['pre_url'] = substr($_SERVER['REQUEST_URI'], 0, strlen($_SERVER['REQUEST_URI']) - strlen('/initialization'));

		require_once __DIR__ . '/../view/init/index.php';
		die();
	}

	private static function intro(): string {
		global $config;

		$check_config = self::check_config();

		if ($check_config == 'success') {
			require_once __DIR__ . '/../database/Database.php';
			if (Database::connect_try()) {
				header('Location: ' . $config['pre_url']);
			}
		}
		ob_start();
		require __DIR__ . '/../view/init/main.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	private static function install() {
		global $config;

		if (!isset($_POST['install'])) {
			return self::intro();
		}

		$check_config = self::check_config();

		if ($check_config != 'success') {
			return self::install_error($check_config);
		}

		require_once __DIR__ . '/../database/Database.php';
		require_once __DIR__ . '/../database/Init.php';

		$db = new \Linwebs\SimpleMessageBoard\Database\Init();

		if($db->init()) {
			return self::install_finish();
		} else {
			return self::install_error('系統安裝失敗，請再次檢查設定檔');
		}
	}

	public static function bootstrap_config() {

		$check_config = self::check_config();

		if (substr($_SERVER['REQUEST_URI'], strlen($_SERVER['REQUEST_URI']) - strlen('/initialization'), strlen('/initialization')) == '/initialization') {
			return self::init();
		}
		if ($check_config != 'success') {
			require_once __DIR__ . '/../view/init/no_init.php';
			die();
		}

		require_once __DIR__ . '/../database/Database.php';

		if (!Database::connect_try()) {
			require_once __DIR__ . '/../view/init/no_init.php';
			die();
		}

		return true;
	}

	private static function check_config(): string {
		$config_path = __DIR__ . '/../config.php';

		if (!is_file($config_path)) {
			return '找不到設定檔 config.php';
		}

		$config = include __DIR__ . '/../config.php';

		$column = array('pre_url', 'website_title', 'anonymous', 'db_host', 'db_port', 'db_name', 'db_user_name',
			'db_user_password');

		foreach ($column as $item) {
			if (!isset($config[$item])) {
				return '設定檔中的 ' . $item . ' 參數未設置';
			}
			if (empty($config[$item])) {
				return '設定檔中的 ' . $item . ' 參數不得為空';
			}
		}
		return 'success';
	}

	private static function install_error(string $msg): string {
		global $config;

		ob_start();
		require __DIR__ . '/../view/init/install_error.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	private static function install_finish(): string {
		global $config;

		ob_start();
		require __DIR__ . '/../view/init/install_finish.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}