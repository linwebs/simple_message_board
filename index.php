<?php

namespace Linwebs\SimpleMessageBoard;

ini_set('display_errors', 1);

require_once __DIR__ . '/src/Bootstrap.php';

new Src\Bootstrap();

switch (Src\Router::url($config['pre_url'], 1)) {
	case '':
		$html['title'] = $config['website_title'] . ' - 首頁';
		$html['content'] = Src\Note::show_notes();
		break;
	case 'new':
		$html['title'] = $config['website_title'] . ' - 新增留言';
		$html['content'] = Src\Note::add_note();
		break;
	case 'login':
		$html['title'] = $config['website_title'] . ' - 登入';
		$html['content'] = Src\User::login();
		break;
	case 'register':
		$html['title'] = $config['website_title'] . ' - 註冊';
		$html['content'] = Src\User::register();
		break;
	case 'logout':
		$html['title'] = $config['website_title'] . ' - 登出';
		$html['content'] = Src\User::logout();
		break;
	case 'initialization':
		$html['title'] = $config['website_title'] . ' - 系統初始化';
		Src\Init::init();
		die();
	default:
		$html['title'] = $config['website_title'] . ' - 頁面找不到';
		$html['content'] = '404 頁面找不到';
		break;
}

Src\Bootstrap::show_page();