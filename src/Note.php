<?php

namespace Linwebs\SimpleMessageBoard\Src;

class Note {
	public static function show_notes() {
		global $config;

		$note_cards = '';

		$db = new \Linwebs\SimpleMessageBoard\Database\Note();

		$notes = $db->get_all_note();

		foreach ($notes as $item) {
			$note_card_content = htmlspecialchars($item['content']);

			if(empty($item['user_name'])) {
				$note_card_user = $config['anonymous'];
			} else {
				$note_card_user = htmlspecialchars($item['user_name']);
			}

			$note_card_time = date('Y/m/d H:i', strtotime($item['time']));

			ob_start();
			require __DIR__ . '/../view/note/note_card_item.php';
			$note_cards .= ob_get_contents();
			ob_end_clean();
		}

		ob_start();
		require __DIR__ . '/../view/note/note_card.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	public static function add_note() {
		if ($_POST) {
			return self::add_note_to_sql();
		} else {
			return self::add_note_form();
		}
	}

	private static function add_note_form() {
		global $config, $html;

		if ($html['user_name']) {
			$user_name = $html['user_name'];
			$user_hint = '(若須匿名留言，請先登出帳號)';
		} else {
			$user_name = $config['anonymous'];
			$user_hint = '(若須署名，請先登入帳號)';
		}
		if (isset($_SESSION['add_note_msg'])) {
			$add_note_msg = $_SESSION['add_note_msg'];
			unset($_SESSION['add_note_msg']);
		} else {
			$add_note_msg = '';
		}

		ob_start();
		require __DIR__ . '/../view/note/add_note.php';
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}

	/**
	 * 新增留言到資料庫
	 * @return string
	 */
	private static function add_note_to_sql(): string {
		global $config;

		if (!isset($_POST['content'])) {
			$_SESSION['add_note_msg'] = '無法取得內容';
			header('Location: ' . $config['pre_url'] . '/new');
			return '新增失敗';
		}

		if (empty($_POST['content'])) {
			$_SESSION['add_note_msg'] = '內容不得為空';
			header('Location: ' . $config['pre_url'] . '/new');
			return '新增失敗';
		}

		$content = $_POST['content'];

		$db = new \Linwebs\SimpleMessageBoard\Database\Note();

		if (isset($_SESSION['user']['id'])) {
			$user = $_SESSION['user']['id'];
		} else {
			$user = null;
		}

		$id = $db->add_note($content, $user);

		if ($id > 0) {
			header('Location: ' . (($config['pre_url'])?($config['pre_url']):('/')));
			return '新增成功';
		} else if($id == -2) {
			$_SESSION['add_note_msg'] = '留言內容過長';
			header('Location: ' . $config['pre_url'] . '/new');
			return '留言內容過長';
		}  else {
			$_SESSION['add_note_msg'] = '請稍後再試';
			header('Location: ' . $config['pre_url'] . '/new');
			return '新增失敗';
		}
	}
}