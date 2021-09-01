<?php

namespace Linwebs\SimpleMessageBoard\Src;

class User {

	public static function login(): string {
		if ($_POST) {
			return self::login_verify();
		} else {
			return self::login_form();
		}
	}

	public static function register(): string {
		if ($_POST) {
			return self::register_verify();
		} else {
			return self::register_form();
		}
	}

	private static function login_form(): string {
		global $config;

		if (isset($_SESSION['login_msg'])) {
			$login_msg = $_SESSION['login_msg'];
			unset($_SESSION['login_msg']);
		} else {
			$login_msg = '';
		}

		ob_start();
		require __DIR__ . '/../view/user/login.php';
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	private static function login_verify(): string {
		global $config;

		$db = new \Linwebs\SimpleMessageBoard\Database\User();

		$account = $_POST['account'];
		$password = $_POST['password'];

		if ($db->verify_user($account, $password)) {
			$user_info = $db->get_single_user_info($account);

			if (isset($user_info['id'])) {
				$_SESSION['user']['id'] = $user_info['id'];
				$_SESSION['user']['name'] = $user_info['name'];
				$_SESSION['user']['account'] = $user_info['account'];
				header('Location: ' . (($config['pre_url'])?($config['pre_url']):('/')));
				return '登入成功';
			}

			$_SESSION['login_msg'] = '資料錯誤';
			header('Location: ' . $config['pre_url'] . '/login');
			return '資料錯誤';
		} else {
			$_SESSION['login_msg'] = '帳號或密碼錯誤';
			header('Location: ' . $config['pre_url'] . '/login');
			return '帳號或密碼錯誤';
		}
	}

	private static function register_verify(): string {
		global $config;

		$db = new \Linwebs\SimpleMessageBoard\Database\User();

		$name = $_POST['name'];
		$account = $_POST['account'];
		$password = $_POST['password'];


		if(strlen($name) > 20) {
			$_SESSION['register_msg'] = '姓名過長';
			header('Location: ' . $config['pre_url'] . '/register');
			return '姓名過長';
		}

		if(strlen($account) > 20) {
			$_SESSION['register_msg'] = '帳號名稱過長';
			header('Location: ' . $config['pre_url'] . '/register');
			return '帳號名稱過長';
		}


		$id = $db->register($account, $password, $name);
		if ($id > 0) {
			$_SESSION['user']['id'] = $id;
			$_SESSION['user']['name'] = htmlspecialchars($name);
			$_SESSION['user']['account'] = $account;
			header('Location: ' . (($config['pre_url'])?($config['pre_url']):('/')));
			return '註冊成功';
		} else if($id == -1) {
			$_SESSION['register_msg'] = '使用者已存在';
			header('Location: ' . $config['pre_url'] . '/register');
			return '註冊失敗';
		} else if($id == -2) {
			$_SESSION['register_msg'] = '帳號名稱或姓名過長';
			header('Location: ' . $config['pre_url'] . '/register');
			return '帳號名稱或姓名過長';
		} else {
			$_SESSION['register_msg'] = '請稍後再試';
			header('Location: ' . $config['pre_url'] . '/register');
			return '註冊失敗';
		}
	}

	private static function register_form(): string {
		global $config;

		if (isset($_SESSION['register_msg'])) {
			$register_msg = $_SESSION['register_msg'];
			unset($_SESSION['register_msg']);
		} else {
			$register_msg = '';
		}

		ob_start();
		require __DIR__ . '/../view/user/register.php';
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	public static function session_verify(): bool {
		if (!isset($_SESSION['user']['id'])) {
			return false;
		}
		if (!isset($_SESSION['user']['name'])) {
			return false;
		}
		if (!isset($_SESSION['user']['account'])) {
			return false;
		}
		return true;
	}

	public static function logout() {
		global $config;

		unset($_SESSION['user']['id']);
		unset($_SESSION['user']['name']);
		unset($_SESSION['user']['account']);

		header('Location: ' . (($config['pre_url'])?($config['pre_url']):('/')));
		return '登出';
	}
}